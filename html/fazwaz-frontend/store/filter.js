export const state = () => ({
    activeStatus: ['Sale'],
    activeProvinces: [],
    activeShow: 25,
    activeSort: 'price-low-to-high',
    search: '',
    page: 1,
});

export const mutations = {
    prevPage(state) {
        if (state.page > 1) {
            state.page--;
        }
    },
    nextPage(state, { propertiesCount }) {
        if (state.page * state.activeShow < propertiesCount) {
            state.page++;
        }
    },
    resetFilter(state) {
        state.search = '';
        state.activeStatus = ['Sale'];
        state.activeProvinces = [];
        state.activeShow = 25;
        state.activeSort = 'price-low-to-high';
    },
    selectActiveProvince(state, { province }) {
        state.page = 1;
        if (state.activeProvinces.includes(province.title)) {
            state.activeProvinces = state.activeProvinces.filter((i) => i !== province.title);
            return true;
        }
        state.activeProvinces.push(province.title);
    },
    selectActiveShow(state, { show }) {
        state.page = 1;
        state.activeShow = show.value;
    },
    selectActiveSort(state, { sort }) {
        state.activeSort = sort.value;
    },
    switchSale(state) {
        state.page = 1;
        if (state.activeStatus.includes('Sale')) {
            state.activeStatus = state.activeStatus.filter((status) => status !== 'Sale');
            return true;
        }
        state.activeStatus.push('Sale');
    },

    switchSold(state) {
        state.page = 1;
        if (state.activeStatus.includes('Sold')) {
            state.activeStatus = state.activeStatus.filter((status) => status !== 'Sold');
            return true;
        }
        state.activeStatus.push('Sold');
    },

    filterBySearch(state, { search }) {
        state.page = 1;
        state.search = search;
    },
    setStatus(state, { status }) {
        state.activeStatus = status;
    },
    setProvinces(state, { provinces }) {
        state.activeProvinces = provinces;
    },
    setShow(state, { show }) {
        state.activeShow = parseInt(show);
    },
    setSort(state, { sort }) {
        state.activeSort = sort;
    },
    setSearch(state, { search }) {
        state.search = search;
    },
};
