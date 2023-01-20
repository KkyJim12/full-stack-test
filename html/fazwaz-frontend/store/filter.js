export const state = () => ({
    activeStatus: ['Sale'],
    activeProvinces: [],
    activeShow: 25,
    activeSort: 'price-low-to-high',
});

export const mutations = {
    resetFilter(state) {
        state.activeStatus = ['Sale'];
        state.activeProvinces = [];
        state.activeShow = 25;
        state.activeSort = 'price-low-to-high';
    },
    selectActiveProvince(state, { province }) {
        if (state.activeProvinces.includes(province.title)) {
            state.activeProvinces = state.activeProvinces.filter((i) => i !== province.title);
            return true;
        }
        state.activeProvinces.push(province.title);
    },
    selectActiveShow(state, { show }) {
        state.activeShow = show.value;
    },
    selectActiveSort(state, { sort }) {
        state.activeSort = sort.value;
    },
    switchSale(state) {
        if (state.activeStatus.includes('Sale')) {
            state.activeStatus = state.activeStatus.filter((status) => status !== 'Sale');
            return true;
        }
        state.activeStatus.push('Sale');
    },

    switchSold(state) {
        if (state.activeStatus.includes('Sold')) {
            state.activeStatus = state.activeStatus.filter((status) => status !== 'Sold');
            return true;
        }
        state.activeStatus.push('Sold');
    },
};
