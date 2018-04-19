<template>
    <div class="m-widget4">
        <!--begin::Widget 14 Item-->
        <div class="m-widget4__item" v-for="result in list">
            <div class="m-widget4__img m-widget4__img--pic">
                <a :href="'/u/'+ result.slug">
                    <img src="assets/app/media/img/users/100_4.jpg" :alt="result.name">
                </a>
            </div>
            <div class="m-widget4__info">
                <span class="m-widget4__title">
                    {{ result.name }}
                </span>
                <br>
                <span class="m-widget4__sub">
                    {{ result.city }} {{ result.country }}
                </span>
            </div>
            <div class="m-widget4__ext">
                <a :href="'/u/'+ result.slug" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                    Seguir
                </a>
            </div>
        </div>
        <h4 v-if='list.length === 0'>
            No hay viajeros disponibles
        </h4>
        <!--end::Widget 14 Item-->
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Ultimos.vue')
        },
        data() {
            return {
                list: []
            };
        },

        created() {
            this.fetchTaskList();
        },

        methods: {
            fetchTaskList() {
                axios.get('api/users/today').then((res) => {
                    this.list = res.data;
                });
            }
        }
    }
</script>
