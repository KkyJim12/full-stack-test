<template>
    <div class="flex flex-col space-y-10">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">Property Hub</h1>
            <button
                class="px-4 py-2 font-semibold text-white bg-red-500 rounded shadow-md focus:outline-none hover:bg-red-700"
                type="button"
                @click="resetFilter()"
            >
                Reset
            </button>
        </div>
        <div class="flex flex-col space-y-4">
            <div class="flex flex-col space-y-2">
                <h4 class="font-semibold">Status</h4>
                <div class="flex space-x-2">
                    <button
                        :class="
                            activeStatus.includes('Sale')
                                ? 'px-4 py-2 font-semibold rounded shadow-md focus:outline-none bg-green-500 text-white'
                                : 'px-4 py-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-green-500 hover:text-white'
                        "
                        type="button"
                        @click="switchSale()"
                    >
                        Sale
                    </button>
                    <button
                        :class="
                            activeStatus.includes('Sold')
                                ? 'px-4 py-2 font-semibold  rounded shadow-md focus:outline-none bg-red-500 text-white'
                                : 'px-4 py-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-red-500 hover:text-white'
                        "
                        type="button"
                        @click="switchSold()"
                    >
                        Sold
                    </button>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <h4 class="font-semibold">Provinces</h4>
                <div class="flex flex-wrap">
                    <button
                        v-for="province in provinces"
                        :key="province.id"
                        class="px-4 py-2 mb-2 mr-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-blue-500 hover:text-white"
                        type="button"
                    >
                        {{ province.title }}
                    </button>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <h4 class="font-semibold">Show</h4>
                <div class="flex flex-wrap">
                    <button
                        v-for="show in shows"
                        :key="show.id"
                        :class="
                            show.id === activeShow.id
                                ? 'px-4 py-2 mb-2 mr-2 font-semibold  rounded shadow-md focus:outline-none bg-blue-500 text-white'
                                : 'px-4 py-2 mb-2 mr-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-blue-500 hover:text-white'
                        "
                        type="button"
                        @click="selectActiveShow(show)"
                    >
                        {{ show.value }}
                    </button>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <h4 class="font-semibold">Provinces</h4>
                <div class="flex flex-wrap">
                    <button
                        v-for="sort in sorts"
                        :key="sort.id"
                        :class="
                            sort.id === activeSort.id
                                ? 'px-4 py-2 mb-2 mr-2 font-semibold  rounded shadow-md focus:outline-none bg-blue-500 text-white'
                                : 'px-4 py-2 mb-2 mr-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-blue-500 hover:text-white'
                        "
                        type="button"
                        @click="selectActiveSort(sort)"
                    >
                        {{ sort.title }}
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
            activeStatus: ['Sale'],
            activeShow: { id: 2, value: 25 },
            activeSort: { id: 1, title: 'Price: low-high' },
            provinces: [],
            shows: [
                { id: 1, value: 10 },
                { id: 2, value: 25 },
                { id: 3, value: 50 },
                { id: 4, value: 100 },
            ],
            sorts: [
                { id: 1, title: 'Price: low-high' },
                { id: 2, title: 'Price: high-low' },
                { id: 3, title: 'Title: a-z' },
                { id: 4, title: 'Title: z-a' },
            ],
        };
    },
    methods: {
        resetFilter() {
            this.activeStatus = ['Sale'];
            this.activeShow = { id: 2, value: 25 };
            this.activeSort = { id: 1, title: 'Price: low-high' };
        },
        selectActiveShow(show) {
            this.activeShow = show;
        },
        selectActiveSort(sort) {
            this.activeSort = sort;
        },
        switchSale() {
            if (this.activeStatus.includes('Sale')) {
                this.activeStatus = this.activeStatus.filter((status) => status !== 'Sale');
                return true;
            }
            this.activeStatus.push('Sale');
        },

        switchSold() {
            if (this.activeStatus.includes('Sold')) {
                this.activeStatus = this.activeStatus.filter((status) => status !== 'Sold');
                return true;
            }
            this.activeStatus.push('Sold');
        },
    },
};
</script>
