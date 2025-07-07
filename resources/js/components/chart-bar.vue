<template>
  <div class="chart-bar">
    <canvas ref="barChart"></canvas>
  </div>
</template>

<script>
import { Chart, BarController, BarElement, CategoryScale, LinearScale, Title, Tooltip, Legend } from 'chart.js'
Chart.register(BarController, BarElement, CategoryScale, LinearScale, Title, Tooltip, Legend)

export default {
  name: 'ChartBar',
  props: {
    title: {
      type: String,
      required: true
    },
    chartData: {
      type: Array,
      required: true
    },
    chartLabels: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      stats: {
        total_tickets: 0,
        tickets_by_status: [],
        tickets_by_category: [],
      },
    };
  },
  updated() {
    new Chart(this.$refs.barChart, {
        type: 'bar',
        data: {
          labels: this.chartLabels,
          datasets: [{
            label: this.title,
            data: this.chartData,
            backgroundColor: [
              'rgba(255, 99, 132, 0.5)',
              'rgba(54, 162, 235, 0.5)',
              'rgba(255, 206, 86, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(153, 102, 255, 0.5)',
              'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54,162,235,1)',
              'rgba(255,206,86,1)',
              'rgba(75,192,192,1)',
              'rgba(153,102,255,1)',
              'rgba(255,159,64,1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { display: true },
            title: {
              display: true,
              text: this.title
            }
          },
          scales: {
            y: { 
                beginAtZero: true ,
                max: Math.max(...this.chartData) + 10
            }
          }
        }
      })
  }
};
</script>
<style scoped>
.chart-bar{
  margin-bottom: 20px;
}
</style>