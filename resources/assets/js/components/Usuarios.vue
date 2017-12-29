<template>
    <div class="m-widget4">
        <!--begin::Widget 14 Item-->
        <div class="m-widget4__item">
            <div class="m-widget4__img m-widget4__img--pic">
                <img src="assets/app/media/img/users/100_4.jpg" alt="">
            </div>
            <div class="m-widget4__info">
                <span class="m-widget4__title">
                    Anna Strong
                </span>
                <br>
                <span class="m-widget4__sub">
                    Visual Designer,Google Inc
                </span>
            </div>
            <div class="m-widget4__ext">
                <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                    Follow
                </a>
            </div>
        </div>
        <!--end::Widget 14 Item-->
        <!--begin::Widget 14 Item-->
        <div class="m-widget4__item">
            <div class="m-widget4__img m-widget4__img--pic">
                <img src="assets/app/media/img/users/100_14.jpg" alt="">
            </div>
            <div class="m-widget4__info">
                <span class="m-widget4__title">
                    Milano Esco
                </span>
                <br>
                <span class="m-widget4__sub">
                    Product Designer, Apple Inc
                </span>
            </div>
            <div class="m-widget4__ext">
                <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                    Follow
                </a>
            </div>
        </div>
        <!--end::Widget 14 Item-->
        <!--begin::Widget 14 Item-->
        <div class="m-widget4__item">
            <div class="m-widget4__img m-widget4__img--pic">
                <img src="assets/app/media/img/users/100_11.jpg" alt="">
            </div>
            <div class="m-widget4__info">
                <span class="m-widget4__title">
                    Nick Bold
                </span>
                <br>
                <span class="m-widget4__sub">
                    Web Developer, Facebook Inc
                </span>
            </div>
            <div class="m-widget4__ext">
                <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                    Follow
                </a>
            </div>
        </div>
        <!--end::Widget 14 Item-->
        <!--begin::Widget 14 Item-->
        <div class="m-widget4__item">
            <div class="m-widget4__img m-widget4__img--pic">
                <img src="assets/app/media/img/users/100_1.jpg" alt="">
            </div>
            <div class="m-widget4__info">
                <span class="m-widget4__title">
                    Wiltor Delton
                </span>
                <br>
                <span class="m-widget4__sub">
                    Project Manager, Amazon Inc
                </span>
            </div>
            <div class="m-widget4__ext">
                <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                    Follow
                </a>
            </div>
        </div>
        <!--end::Widget 14 Item-->
        <!--begin::Widget 14 Item-->
        <div class="m-widget4__item">
            <div class="m-widget4__img m-widget4__img--pic">
                <img src="assets/app/media/img/users/100_5.jpg" alt="">
            </div>
            <div class="m-widget4__info">
                <span class="m-widget4__title">
                    Nick Stone
                </span>
                <br>
                <span class="m-widget4__sub">
                    Visual Designer, Github Inc
                </span>
            </div>
            <div class="m-widget4__ext">
                <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                    Follow
                </a>
            </div>
        </div>
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
                axios.get('api/message/1').then((res) => {
                    this.list = res.data;
                });
            }
        }
    }
</script>
