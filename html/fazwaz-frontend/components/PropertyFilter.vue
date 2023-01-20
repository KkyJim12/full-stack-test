<template>
    <div class="flex flex-col space-y-10">
        <h1 class="text-4xl font-bold">Property Hub</h1>
        <div class="flex flex-col space-y-4">
            <div class="flex flex-col space-y-2">
                <h4 class="font-semibold">Status</h4>
                <div class="flex space-x-2">
                    <button
                        class="px-4 py-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-green-500 hover:text-white"
                        type="button"
                    >
                        Sale
                    </button>
                    <button
                        class="px-4 py-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-red-500 hover:text-white"
                        type="button"
                    >
                        Sold
                    </button>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <h4 class="font-semibold">Provinces</h4>
                <div class="flex flex-wrap space-x-2">
                    <button
                        v-for="province in provinces"
                        :key="province.id"
                        class="px-4 py-2 mb-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-blue-500 hover:text-white"
                        type="button"
                    >
                        {{ province.title }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            provinces: [
                { id: 1, title: 'Bangkok' },
                { id: 2, title: 'Chiang mai' },
                { id: 3, title: 'Chiang rai' },
                { id: 4, title: 'Phuket' },
                { id: 5, title: 'Krabi' },
                { id: 6, title: 'Nakorn nayok' },
                { id: 7, title: 'Samut prakarn' },
                { id: 8, title: 'Ayuttaya' },
            ],
        };
    },
};
</script>
