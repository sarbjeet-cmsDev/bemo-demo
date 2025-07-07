<template>
  <div class="pagination">
    <ul class="pagination">
        <li class="pagination__item">
            <span class="pagination__link" href="#" tabindex="-1" @click="prevPage">Previous</span>
        </li>
        <li class="pagination__item" v-for="page in visiblePages" :key="page"  :class="{ active: page === currentPage }">
            <span class="pagination__link" href="#" @click="goToPage(page)">{{ page }}</span>
        </li>
        <li class="pagination__item"  :disabled="currentPage === totalPages" :class="{ active: currentPage === totalPages }">
            <span class="pagination__link" href="#" @click="nextPage">Next</span>
        </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    totalPages: {
      type: Number,
      required: true
    }
  },
  computed: {
    visiblePages() {
      const pages = [];
      if (this.totalPages <= 5) {
        for (let i = 1; i <= this.totalPages; i++) {
          pages.push(i);
        }
      } else {
        if (this.currentPage <= 3) {
          pages.push(1, 2, 3, '...', this.totalPages);
        } else if (this.currentPage >= this.totalPages - 2) {
          pages.push(1, '...', this.totalPages - 2, this.totalPages - 1, this.totalPages);
        } else {
          pages.push(1, '...', this.currentPage - 1, this.currentPage, this.currentPage + 1, '...', this.totalPages);
        }
      }
      return pages;
    }
  },
  methods: {
    prevPage() {
      if (this.currentPage > 1) {
        this.$emit('update:currentPage', this.currentPage - 1);
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.$emit('update:currentPage', this.currentPage + 1);
      }
    },
    goToPage(page) {
      if (page !== '...') {
        this.$emit('update:currentPage', page);
      }
    }
  }
};
</script>

<style scoped>
/* Block */
.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  border-radius: 0.25rem;
  margin-top: 1rem;
}

/* Element: item (li) */
.pagination__item {
  margin: 0 2px;
}

/* Element: link (a) */
.pagination__link {
  position: relative;
  display: block;
  padding: 0.5rem 0.75rem;
  color: #007bff;
  background-color: transparent;
  text-decoration: none;
  border-radius: 0.25rem;
  transition: background 0.15s, color 0.15s;
}

.pagination__link:focus {
  color: #fff;
  background-color:transparent;
  border-color: #dee2e6;
  text-decoration: none;
}

/* Modifier: active */
.pagination__item.active{
  background-color: #007bff;
  color: #fff;
}

.pagination__item.active .pagination__link{
  color: #fff;
}

/* Modifier: disabled */
.pagination__item--disabled .pagination__link {
  color: #6c757d;
  pointer-events: none;
  background-color: #fff;
  border-color: #dee2e6;
  cursor: not-allowed;
}
</style>

