<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
span class="m-widget4__sub">
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
            console.log('Component mounted.')
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
