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
                <h4 class="font-semibold">Search</h4>
                <form class="flex space-x-2" @submit.prevent="filterBySearch()">
                    <input
                        v-model="searchInput"
                        class="w-full px-4 py-2 text-gray-600 rounded shadow-md focus:outline-none"
                        type="text"
                        placeholder="Search by title or location"
                    />
                    <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                        Search
                    </button>
                </form>
            </div>
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
                        :class="
                            activeProvinces.includes(province.title)
                                ? 'px-4 py-2 mb-2 mr-2 font-semibold  rounded shadow-md focus:outline-none bg-blue-500 text-white'
                                : 'px-4 py-2 mb-2 mr-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-blue-500 hover:text-white'
                        "
                        type="button"
                        @click="selectActiveProvince(province)"
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
                            show.value === activeShow
                                ? 'px-4 py-2 mb-2 mr-2 font-semibold  rounded shadow-md focus:outline-none bg-yellow-500 text-white'
                                : 'px-4 py-2 mb-2 mr-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-yellow-500 hover:text-white'
                        "
                        type="button"
                        @click="selectActiveShow(show)"
                    >
                        {{ show.value }}
                    </button>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <h4 class="font-semibold">Sort</h4>
                <div class="flex flex-wrap">
                    <button
                        v-for="sort in sorts"
                        :key="sort.id"
                        :class="
                            sort.value === activeSort
                                ? 'px-4 py-2 mb-2 mr-2 font-semibold  rounded shadow-md focus:outline-none bg-purple-500 text-white'
                                : 'px-4 py-2 mb-2 mr-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-purple-500 hover:text-white'
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
            searchInput: '',
            provinces: [],
            shows: [
                { id: 1, value: 10 },
                { id: 2, value: 25 },
                { id: 3, value: 50 },
                { id: 4, value: 100 },
            ],
            sorts: [
                { id: 1, title: 'Price: low-high', value: 'price-low-to-high' },
                { id: 2, title: 'Price: high-low', value: 'price-high-to-low' },
                { id: 3, title: 'Title: a-z', value: 'title-a-to-z' },
                { id: 4, title: 'Title: z-a', value: 'title-z-to-a' },
            ],
        };
    },
    async fetch() {
        await this.getProvinces();
    },
    computed: {
        activeStatus() {
            return this.$store.state.filter.activeStatus;
        },
        activeProvinces() {
            return this.$store.state.filter.activeProvinces;
        },
        activeShow() {
            return this.$store.state.filter.activeShow;
        },
        activeSort() {
            return this.$store.state.filter.activeSort;
        },
        page() {
            return this.$store.state.filter.page;
        },
        search() {
            return this.$store.state.filter.search;
        },
    },
    methods: {
        resetFilter() {
            this.$store.commit('filter/resetFilter');
            if (this.provinces.length) {
                this.selectActiveProvince(this.provinces[0]);
            }
            this.replaceQueryParams();
        },
        selectActiveProvince(province) {
            this.$store.commit('filter/selectActiveProvince', { province });
            this.replaceQueryParams();
        },
        selectActiveShow(show) {
            this.$store.commit('filter/selectActiveShow', { show });
            this.replaceQueryParams();
        },
        selectActiveSort(sort) {
            this.$store.commit('filter/selectActiveSort', { sort });
            this.replaceQueryParams();
        },
        switchSale() {
            this.$store.commit('filter/switchSale');
        },

        switchSold() {
            this.$store.commit('filter/switchSold');
            this.replaceQueryParams();
        },

        filterBySearch() {
            this.$store.commit('filter/filterBySearch', { search: this.searchInput });
            this.replaceQueryParams();
        },

        async getProvinces() {
            try {
                const response = await this.$axios.get(`/api/v1/provinces`);
                this.provinces = response.data.data;
                if (this.provinces.length) {
                    this.selectActiveProvince(this.provinces[0]);
                }
            } catch (error) {
                console.log(error.response)
            }
        },

        replaceQueryParams() {
            const status = this.activeStatus ? this.activeStatus.join(',') : '';
            const provinces = this.activeProvinces ? this.activeProvinces.join(',') : '';
            const show = this.activeShow;
            const sort = this.activeSort;
            const page = this.page;
            const search = this.search;
            const queryParams = {
                status: status,
                provinces: provinces,
                sort: sort,
                page: page,
                limit: show,
                search: search,
            };

            this.$router.replace({ query: queryParams });
        },
    },
};
</script>
