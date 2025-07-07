import api from './api';

const statsService = {
  async getStats() {
    try {
      const response = await api.get('/tickets/stats');
      return response.data;
    } catch (error) {
      console.error('Error fetching stats:', error);
      throw error;
    }
  }
};

export default statsService;
