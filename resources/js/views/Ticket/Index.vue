<template>
    <div>
        <div class="data-grid">
            <div class="data-grid__header">
                <h2 class="data-grid__title">Ticket List</h2>
                <div class="data-grid__actions">
                    <input type="text" class="form__control data-grid__search-input" placeholder="Search ..."
                        v-model="searchQuery" @input="onSearchQueryChange">
                    <select class="form__control" v-model="searchStatus" @change="onSearchStatusChange">
                        <option value="">All</option>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                    </select>
                    <button class="btn btn--primary" @click="exportCsv">Export CSV</button>
                    <button class="btn btn--primary" @click="showNewTicketModal = true">New Ticket</button>
                </div>
            </div>
            <div class="data-grid__table-wrapper table-responsive">
                <table class="table table-striped data-grid__table">
                    <thead class="data-grid__table-head">
                        <tr class="data-grid__table-row">
                            <th class="data-grid__table-cell">#</th>
                            <th class="data-grid__table-cell">Subject</th>
                            <th class="data-grid__table-cell">Category</th>
                            <th class="data-grid__table-cell">confidence</th>
                            <th class="data-grid__table-cell">Status</th>
                            <th class="data-grid__table-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="data-grid__table-body">
                        <tr v-for="(ticket, index) in tickets" :key="ticket.id" class="data-grid__table-row">
                            <td class="data-grid__table-cell ">{{ index + 1 }}</td>
                            <td class="data-grid__table-cell "><span class="tooltip-icon" :title="ticket.explanation" style="cursor: help;"> {{ ticket.subject }}</span></td>
                            <td class="data-grid__table-cell">{{ ticket.category || 'N/A' }}</td>
                            <td class="data-grid__table-cell">{{ ticket.confidence }}%</td>
                            <td class="data-grid__table-cell">
                                {{ ticket.status }}
                                <span v-if="ticket.note" class="badge data-grid__table-cell">Note</span>
                            </td>
                            <td class="data-grid__table-cell">
                                <a class="link" @click="router.push(`/ticket/${ticket.id}`)">View</a>
                                <a class="link" @click="confirmDeleteTicket(ticket.id)">Delete</a>
                                <a class="link" @click="confirmClassifyTicket(ticket.id)">Classify</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <Pagination :currentPage="currentPage" :totalPages="totalPages" @update:currentPage="onPageChange" />
        </div>

        <Modal :visible="showNewTicketModal" @close="showNewTicketModal = false" :showCloseButton="true">
            <template #header>
                <h2>New Ticket</h2>
            </template>
            <template #body>
                <form @submit.prevent="createTicket">
                    <div class="form__group">
                        <label for="subject" class="form__label">Subject</label>
                        <input type="text" class="form__control" id="subject" placeholder="Enter subject" required
                            v-model="newTicket.subject">
                    </div>
                    <div class="form__group">
                        <label for="body" class="form__label">Body</label>
                        <textarea class="form__control" id="body" placeholder="Enter body" required
                            v-model="newTicket.body"></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary">Submit</button>
                </form>
            </template>
            <template #footer>
                <button type="button" class="btn btn-secondary" @click="showNewTicketModal = false">Close</button>
            </template>
        </Modal>
    </div>

    <Loader :isLoading="isLoading" />
</template>

<script>
import ticketService from '@/services/ticketService';
import Pagination from '@/components/pagination.vue';
import Modal from '@/components/modal.vue';
import alertService from '@/services/alert';
import { useRouter } from 'vue-router';
import Loader from '@/components/loader.vue';

export default {
    components: {
        Pagination,
        Modal,
        Loader
    },
    data() {
        return {
            router: useRouter(),
            tickets: [],
            searchQuery: '',
            searchStatus: '',
            currentPage: 1,
            itemsPerPage: 10,
            totalPages: 1,
            showNewTicketModal: false,
            newTicket: {
                subject: '',
                body: '',
                category: '',
                note: ''
            },
            isLoading: false
        };
    },
    computed: {
        startIndex() {
            return (this.currentPage - 1) * this.itemsPerPage;
        },
        endIndex() {
            return this.currentPage * this.itemsPerPage;
        }
    },
    methods: {
        onSearchQueryChange() {
            this.currentPage = 1;
            if (this.searchQuery.length > 3) {
                this.fetchTickets();
            }
            this.fetchTickets();
        },
        onSearchStatusChange() {
            this.currentPage = 1;
            this.fetchTickets();
        },
        async fetchTickets() {
            try {
                const response = await ticketService.getTickets({
                    search: this.searchQuery,
                    per_page: this.itemsPerPage,
                    page: this.currentPage,
                    status: this.searchStatus
                });
                this.tickets = response.data.data.map(ticket => ({
                    ...ticket,
                    isClassifying: false
                }));

                this.totalPages = response.data.last_page;
                this.currentPage = response.data.current_page;
                this.per_page = response.data.per_page;

            } catch (error) {
                console.error('Error fetching tickets:', error);
            }
        },
        async confirmClassifyTicket(id) {
            const result = await alertService.confirm('Are you sure you want to classify this ticket?');
            if (result.isConfirmed) {
                await this.classifyTicket(id);
            }
        },
        async classifyTicket(id) {
            this.isLoading = true;
            try {
                await ticketService.classifyTicket(id);
            } catch (error) {
                console.error('Error classifying ticket:', error);
            } finally {
                this.isLoading = false;
            }
        },
        onPageChange(page) {
            this.currentPage = page;
            this.fetchTickets();
        },
        async createTicket() {
            try {
                const response = await ticketService.createTicket(this.newTicket);
                this.tickets.push({
                    ...response.data,
                    isClassifying: false
                });
                this.showNewTicketModal = false;
                this.newTicket = { subject: '', body: '', category: '', note: '' };
                alertService.success('Ticket created successfully');

                this.fetchTickets();
            } catch (error) {
                console.error('Error creating ticket:', error);
            }
        },
        async deleteTicket(id) {
            try {
                await ticketService.deleteTicket(id);
                this.fetchTickets();
                alertService.success('Ticket deleted successfully');
            } catch (error) {
                console.error('Error deleting ticket:', error);
            }
        },
        async confirmDeleteTicket(id) {
            const result = await alertService.confirm('Are you sure you want to delete this ticket?');
            if (result.isConfirmed) {
                await this.deleteTicket(id);
            }
        },
        async exportCsv() {
            const response = await ticketService.exportCsv({
                search: this.searchQuery,
                status: this.searchStatus
            });
            const link = document.createElement('a');
            link.href = response.data.download_url;
            link.setAttribute('download', 'tickets.csv');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            window.URL.revokeObjectURL(url);
        },
        handleEscPress(event) {
            if (event.key === 'Escape') {
                this.searchQuery = '';
                this.searchStatus = '';
                this.fetchTickets();
            }
        }
    },
    mounted() {
        document.addEventListener('keydown', this.handleEscPress);
        this.fetchTickets();
    },
    beforeDestroy() {
        document.removeEventListener('keydown', this.handleEscPress);
    },
};
</script>
<style>
.data-grid__table-cell a.link {
    margin-right: 10px;
}
</style>
