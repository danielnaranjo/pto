<template>
    <div class="m-list-timeline__items">
        <div class="m-list-timeline__item" v-for="mensaje in list">
            <span class="m-list-timeline__badge"></span>
            <span class="m-list-timeline__text">
                <a :href="'/mensajes/'+ mensaje.message_id">
                    {{ mensaje.comment }}
                </a><br>
                <small>{{ mensaje.name }}</small>
            </span>
            <span class="m-list-timeline__time">
                {{ mensaje.createdAt  | moment("from", "now")  }}
            </span>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Mensajes.vue')
    },
    data() {
        return {
            list: []
        };
    },

    created() {
        this.getList();
    },

    methods: {
        getList() {
            axios.get('/api/message/1').then((res) => {
                this.list = res.data;
            });
        }
    }
}
</script>
