<template>
    <div class="flex flex-col space-y-10">
        <div class="flex justify-between">
            <h1 class="text-4xl font-bold">Results {{ `(${currentCount}/${propertiesCount})` }}</h1>
            <div class="flex space-x-2">
                <button
                    class="px-4 py-1 font-semibold text-gray-700 bg-gray-300 rounded hover:bg-gray-400"
                    type="button"
                    @click="prevPage()"
                >
                    Prev
                </button>

                <div
                    class="flex items-center justify-center px-4 py-1 font-semibold text-gray-700 bg-gray-300 rounded-full"
                >
                    {{ page }}
                </div>
                <button
                    class="px-4 py-1 font-semibold text-gray-700 bg-gray-300 rounded hover:bg-gray-400"
                    type="button"
                    @click="nextPage()"
                >
                    Next
                </button>
            </div>
        </div>
        <div class="grid grid-cols-5 gap-5">
            <div v-for="property in properties" :key="property.id" class="col-span-1">
                <PropertyCard
                    :image="property.photo_thumb"
                    :sold="Boolean(property.is_sold)"
                    :title="property.title"
                    :province="property.province.title"
                    :street="property.street"
                    :price="property.price"
                />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            currentCount: 0,
            propertiesCount: 0,
            properties: [],
        };
    },
    async fetch() {
        await this.getProperties();
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
    watch: {
        '$route.query': '$fetch',
    },
    methods: {
        async getProperties() {
            try {
                const status = this.$route.query.status;
                const provinces = this.$route.query.provinces;
                const sort = this.$route.query.sort;
                const page = this.page;
                const show = this.$route.query.limit;
                const search = this.$route.query.search;
                const response = await this.$axios.get(
                    `/api/v1/properties?status=${status}&provinces=${provinces}&sort=${sort}&page=${page}&limit=${show}&search=${search}`
                );
                this.properties = response.data.data;
                this.propertiesCount = response.data.count;
                this.currentCount = this.activeShow * (this.page - 1) + this.properties.length;
            } catch (error) {
                console.log(error.response);
            }
        },
        async prevPage() {
            this.$store.commit('filter/prevPage');
            await this.getProperties();
        },
        async nextPage() {
            this.$store.commit('filter/nextPage', { propertiesCount: this.propertiesCount });
            await this.getProperties();
        },
    },
};
</script>
