<template>
  <div class="dashboard">
    <div class="stats">
      <div class="stats-row">
          <div v-for="(row, index) in stats.tickets_by_status" :key="index" class="stat-box">
            <h2>{{ row.status?.toUpperCase() }}</h2>
            <p>{{ row.total }}</p>
          </div>
      </div>
      <chart-bar :chart-data="statusChartData.data" :chart-labels="statusChartData.labels" title="Tickets by Status"></chart-bar>


      <div class="stats-row">
          <div v-for="(row, index) in stats.tickets_by_category" :key="index" class="stat-box">
            <h2>{{ row.category?.toUpperCase() }}</h2>
            <p>{{ row.total }}</p>
          </div>
      </div>

      <chart-bar :chart-data="categoryChartData.data" :chart-labels="categoryChartData.labels" title="Tickets by Category"></chart-bar>
    </div>
  </div>
</template>
<script>
import statsService from '@/services/stats';
import ChartBar from '@/components/chart-bar.vue';

export default {
  name: 'Dashboard',
  components: {
    ChartBar
  },
  data() {
    return {
      stats: {
        total_tickets: 0,
        tickets_by_status: [],
        tickets_by_category: [],
      },
      statusChartData: {
        labels: [],
        data: [],
      },
      categoryChartData: {
        labels: [],
        data: [],
      },
    };
  },
  methods: {
    async fetchStats() {
      const response = await statsService.getStats();
      this.stats = response;

      this.statusChartData.labels = this.stats.tickets_by_status.map(item => item.status);
      this.statusChartData.data = this.stats.tickets_by_status.map(item => item.total);


      this.categoryChartData.labels = this.stats.tickets_by_category.map(item => item.category);
      this.categoryChartData.data = this.stats.tickets_by_category.map(item => item.total);

      console.log(this.statusChartData);
      console.log(this.categoryChartData);
    },
  },
  mounted() {
    this.fetchStats();
  }
};
</script>
<style scoped>
  .stats-row{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 20px;
  }
  h1{
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--theme-text-color);
    margin-bottom: 30px;
  }
  .stat-box{
    background-color: var( --theme-color);
    border-radius: 8px;
    box-shadow: 0 4px 8px var(--theme-text-color);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .stat-box h2{
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--theme-text-color);
    margin-bottom: 10px;
  }
  .stat-box:hover{
    background-color: var(--stat-hover-bg);
  }
</style>
