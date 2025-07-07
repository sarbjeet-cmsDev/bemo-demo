import api from './api';

export const ticketService = {
  // Get all tickets with optional filters
  getTickets(params = {}) {
     console.log('Calling /tickets with:', params); // ✅ Now it's valid
    return api.get('/tickets', { params });
  },

  // Get all tickets with optional filters
  exportCsv(params = {}) {
    return api.get('/tickets/export-csv', { params });
  },

  // Get single ticket by ID
  getTicket(id) {
    return api.get(`/tickets/${id}`);
  },

  // Create new ticket
  createTicket(ticketData) {
    return api.post('/tickets', ticketData);
  },

  // Update ticket
  updateTicket(id, ticketData) {
    return api.patch(`/tickets/${id}`, ticketData);
  },

  // Delete ticket
  deleteTicket(id) {
    return api.delete(`/tickets/${id}`);
  },

  // Classify ticket
  classifyTicket(id) {
    return api.post(`/tickets/${id}/classify`);
  },

  // Get ticket statistics
  getStats() {
    return api.get('/tickets/stats');
  },
};

export default ticketService;
