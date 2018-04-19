<template>
    <div class="m-portlet m--bg-accent m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Viajando de
                        {{ $travel->to->name }} a
                        {{ $travel->from->name }}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover">
                        <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
                            <i class="la la-ellipsis-h m--font-light"></i>
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first">
                                                <span class="m-nav__section-text">
                                                    Siguenos en:
                                                </span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon fa fa-facebook-official"></i>
                                                    <span class="m-nav__link-text">
                                                        Facebook
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon fa fa-google-plus"></i>
                                                    <span class="m-nav__link-text">
                                                        Google+
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon fa fa-instagram"></i>
                                                    <span class="m-nav__link-text">
                                                        Instagram
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon fa fa-twitter"></i>
                                                    <span class="m-nav__link-text">
                                                        Twitter
                                                    </span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin::Widget 7-->
            <div class="m-widget7 m-widget7--skin-dark">
                <div class="m-widget7__desc">
                    Tengo disponible
                    {{ travel.weight }}
                    para llevar {{ travel.dimensions }}
                    pero {{ travel.restrictions }}
                </div>
                <div class="m-widget7__user">
                    <div class="m-widget7__user-img">
                        <img class="m-widget7__img" src="assets/app/media/img//users/100_3.jpg" alt="">
                    </div>
                    <div class="m-widget7__info">
                        <span class="m-widget7__username">
                            Dan Bold
                        </span>
                        <br>
                        <span class="m-widget7__time">
                            3 days ago
                        </span>
                    </div>
                </div>
                <div class="m-widget7__button">
                    <a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">
                        All Feeds
                    </a>
                </div>
            </div>
            <!--end::Widget 7-->
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Viajes.vue')
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
                axios.get('/api/traveller').then((res) => {
                    this.list = res.data;
                });
            }
        }
    }
</script>
