<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Vue 3 SPA - Ticket Management</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div id="app" class="min-h-screen">
            <div class="container mx-auto px-4 py-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ message }}</h1>
                    
                    <div v-if="loading" class="text-center">
                        <p class="text-gray-600">Loading tickets...</p>
                    </div>
                    
                    <div v-else>
                        <h2 class="text-xl font-semibold mb-4">Tickets ({{ tickets.length }})</h2>
                        
                        <div v-if="tickets.length === 0" class="text-gray-500">
                            No tickets found.
                        </div>
                        
                        <div v-else class="space-y-4">
                            <div 
                                v-for="ticket in tickets" 
                                :key="ticket.id"
                                class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50"
                            >
                                <h3 class="font-semibold text-lg">{{ ticket.subject }}</h3>
                                <p class="text-gray-600 mt-2">{{ ticket.body }}</p>
                                <div class="mt-3 flex gap-2">
                                    <span 
                                        class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm"
                                    >
                                        {{ ticket.status }}
                                    </span>
                                    <span 
                                        v-if="ticket.category"
                                        class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
                                    >
                                        {{ ticket.category }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @vite(['resources/js/app.js'])
    </body>
</html>
