<template>
  <div>
    <div class="ticket-details-header">
      <h1>Ticket Details</h1>
      <div>
        <button class="btn btn--primary" @click="updateTicket">Save</button>
        <button class="btn btn--primary" @click="confirmClassifyTicket(ticket.id)">Run Classification</button>
      </div>
    </div>
    <div class="ticket-details">
      <div class="ticket-details__item">
        <strong>Subject:</strong>
        <p>{{ ticket.subject }}</p>
      </div>
      <div class="ticket-details__item">
        <strong>Body:</strong>
        <p>{{ ticket.body }}</p>
      </div>
      <div class="ticket-details__item">
        <strong>Category:</strong>
        <input type="text" v-model="ticket.category" class="form__control" />
      </div>
      <div class="ticket-details__item">
        <strong>Note:</strong>
        <textarea v-model="ticket.note" class="form__control"></textarea>
      </div>
      <div class="ticket-details__item">
        <strong>Explanation:</strong>
        <p>{{ ticket.explanation }}</p>
      </div>
      <div class="ticket-details__item">
        <strong>Confidence:</strong>
        <p>{{ ticket.confidence }}%</p>
      </div>
    </div>
  </div>
  <Loader :isLoading="isLoading" />
</template>

<script>
import ticketService from '@/services/ticketService';
import alertService from '@/services/alert';
import Loader from '@/components/loader.vue';

export default {
  components: {
    Loader
  },
  data() {
    return {
      ticket: {
        subject: '',
        body: '',
        category: '',
        note: '',
        explanation: '',
        confidence: 0
      },
      isLoading: false
    };
  },
  methods: {
    async fetchTicket() {
      try {
        const response = await ticketService.getTicket(this.$route.params.id);
        this.ticket = response.data;
      } catch (error) {
        console.error('Error fetching ticket:', error);
        alertService.error('Error fetching ticket');
      }
    },
    async updateTicket() {
      try {
        await ticketService.updateTicket(this.$route.params.id, {
          category: this.ticket.category,
          note: this.ticket.note,
        });
        alertService.success('Ticket updated successfully');
      } catch (error) {
        console.error('Error updating ticket:', error);
        alertService.error('Error updating ticket');
      }
    },
    async runClassification() {
      this.isClassifying = true;
      try {
        await ticketService.classifyTicket(this.$route.params.id);
        alertService.success('Classification job dispatched successfully');
        this.fetchTicket(); // Refresh ticket details
      } catch (error) {
        console.error('Error classifying ticket:', error);
        alertService.error('Error classifying ticket');
      } finally {
        this.isClassifying = false;
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
  },
  mounted() {
    this.fetchTicket();
  }
};
</script>

<style scoped>
.ticket-details-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.ticket-details-header button{
  margin-left: 20px;
}
.ticket-details {
  margin: 20px 0;
}
.ticket-details__item {
  margin-bottom: 15px;
}
.ticket-details__item strong {
  display: block;
  margin-bottom: 5px;
}
</style>
