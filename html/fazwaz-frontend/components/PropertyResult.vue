<template>
    <div class="flex flex-col space-y-10">
        <h1 class="text-4xl font-bold">Results ({{properties.length}})</h1>
        <div class="grid grid-cols-5 gap-5">
            <div v-for="property in properties" :key="property.id" class="col-span-1">
                <PropertyCard
                    :image="property.photo_thumb"
                    :isSold="property.is_sold"
                    :title="property.title"
                    :province="property.province.title"
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
    },
    watch: {
        async '$route.query'() {
            await this.getProperties();
        },
    },
    methods: {
        async getProperties() {
            try {
                const status = this.activeStatus ? this.activeStatus.join(',') : null;
                const provinces = this.activeProvinces ? this.activeProvinces.join(',') : null;
                const sort = this.activeSort;
                const page = this.page;
                const show = this.activeShow;
                const response = await this.$axios.get(
                    `/api/v1/properties?status=${status}&provinces=${provinces}&sort=${sort}&page=${page}&limit=${show}`
                );
                this.properties = response.data.data;
            } catch (error) {
                console.log(error.response.data);
            }
        },
    },
};
</script>
