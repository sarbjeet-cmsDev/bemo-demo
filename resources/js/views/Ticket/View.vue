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

      <div class="ticket-details__item ticket-category-autocomplete">
        <strong>Category:</strong>
        <input
          type="text"
          v-model="ticket.category"
          class="form__control"
          @focus="showAllCategories"
          @blur="hideCategorySuggestions"
          @input="onCategoryInput"
          autocomplete="off"
        />
        <ul v-if="showCategorySuggestions && filteredCategories.length" class="autocomplete-list">
          <li
            v-for="cat in filteredCategories"
            :key="cat.id || cat"
            @mousedown.prevent="selectCategory(cat)"
            class="autocomplete-item"
          >
            {{ cat.name || cat }}
          </li>
        </ul>
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

    <Loader :isLoading="isLoading" />
  </div>
</template>

<script>
import ticketService from '@/services/ticketService';
import alertService from '@/services/alert';
import Loader from '@/components/loader.vue';

export default {
  components: {
    Loader,
  },
  data() {
    return {
      ticket: {
        subject: '',
        body: '',
        category: '',
        note: '',
        explanation: '',
        confidence: 0,
      },
      isLoading: false,
      categories: [],
      showCategorySuggestions: false,
      filteredCategories: [],
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

    async fetchCategories() {
      try {
        const response = await ticketService.getCategories();
        if(response.data.length > 0) {
          this.categories = response.data.filter(cat => cat !== null && cat !== undefined);
          this.filteredCategories = this.categories.slice();
        }
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },

    onCategoryInput() {
      // ✅ Always show all categories, do not filter
      this.showCategorySuggestions = !!this.filteredCategories.length;
    },

    showAllCategories() {
      this.filteredCategories = this.categories.slice();
      this.showCategorySuggestions = !!this.filteredCategories.length;
    },

    selectCategory(cat) {
      this.ticket.category = cat.name || cat;
      this.showCategorySuggestions = false;
    },

    hideCategorySuggestions() {
      setTimeout(() => {
        this.showCategorySuggestions = false;
      }, 150);
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

    async confirmClassifyTicket(id) {
      const result = await alertService.confirm(
        'Are you sure you want to classify this ticket?'
      );
      if (result.isConfirmed) {
        await this.classifyTicket(id);
      }
    },

    async classifyTicket(id) {
      this.isLoading = true;
      try {
        await ticketService.classifyTicket(id);
        alertService.success('Classification job dispatched successfully');
        this.fetchTicket();
      } catch (error) {
        console.error('Error classifying ticket:', error);
        alertService.error('Error classifying ticket');
      } finally {
        this.isLoading = false;
      }
    },
  },

  mounted() {
    this.fetchTicket();
    this.fetchCategories();
  },
};
</script>

<style scoped>
.ticket-details-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.ticket-details-header button {
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

/* Autocomplete styles */
.ticket-category-autocomplete {
  position: relative;
}

.autocomplete-list {
  position: absolute;
  background: #fff;
  z-index: 10;
  border: 1px solid #ccc;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  margin-top: 2px;
  padding: 0;
  list-style: none;
}

.autocomplete-item {
  padding: 8px 10px;
  cursor: pointer;
}

.autocomplete-item:hover {
  background: #f0f0f0;
}
</style>
