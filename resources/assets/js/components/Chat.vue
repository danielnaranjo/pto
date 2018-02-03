<template>
<div class="m-quick-sidebar__content m--hide">
    <span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
        <i class="la la-close"></i>
    </span>
    <!-- component -->
    <ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
        <!-- <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab" aria-expanded="false">
                Daniel N.
            </a>
        </li> -->
        <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link" data-toggle="tab" href="#paquetochat" role="tab" aria-expanded="false">
                Paqueto Chat
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active m-scrollable" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
            <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light" v-for="mensaje in mensajes">
                <div class="m-messenger__messages mCustomScrollbar _mCS_9 mCS-autoHide" style="height: 89px; position: relative; overflow: visible;">
                    <div id="mCSB_9" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;">
                        <div id="mCSB_9_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">

                            <!-- entrante -->
                            <div class="m-messenger__message m-messenger__message--out">
                                <div class="m-messenger__message-body">
                                    <div class="m-messenger__message-arrow"></div>
                                    <div class="m-messenger__message-content">
                                        <div class="m-messenger__message-text">
                                            {{ mensaje.comment }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- entrante -->

                            <!-- saliente -->
                          <div class="m-messenger__message m-messenger__message--in">
                                <div class="m-messenger__message-pic">
                                    <img src="/assets/app/media/img//users/user3.jpg" alt="" class="mCS_img_loaded">
                                </div>
                                <div class="m-messenger__message-body">
                                    <div class="m-messenger__message-arrow"></div>
                                    <div class="m-messenger__message-content">
                                        <div class="m-messenger__message-username">
                                            Megan wrote
                                        </div>
                                        <div class="m-messenger__message-text">
                                            Will the development team be joining ?
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- saliente -->

                            <!-- fecha -->
                            <div class="m-messenger__datetime">2:30PM</div>
                            <!-- fecha -->

                        </div>
                    </div>
                </div>
                <div class="m-messenger__seperator"></div>
                <form action="#" @submit.prevent="enviar()">
                    <div class="m-messenger__form">
                        <div class="m-messenger__form-controls">
                            <input type="text" placeholder="Escribe aquí..." class="m-messenger__form-input" v-model="mensaje.body" >
                            <input type="hidden" v-model="mensaje.to_id" >
                        </div>
                        <div class="m-messenger__form-tools">
                            <a href="" class="m-messenger__form-attachment">
                                <i class="fa fa-paper-plane-o"></i>
                            </a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- component -->
</div>
</template>

<script>
export default {
        mounted() {
            console.log('Mensajes mounted.')
        },
        props: {
            id:{
                type: Number
            }
        },
        data() {
            return {
                mensajes: [],
                mensaje: {
                    id: '',
                    body: ''
                }
            }
        },
        created() {
            this.getList(this.id);
        },
        methods: {
            getList(id) {
                axios.get('/api/message/'+id).then((res) => {
                    //console.log('@ axios.get', JSON.stringify(res) );
                    this.mensajes = res.data;
                });
            },
            enviar() {
                axios.post('/message', this.mensaje)
                    .then((res) => {
                        this.mensaje.body = '';
                        //this.mensaje.to_id = '';
                        this.getList(this.id);
                    })
                    .catch((err) => console.error(err));
            }
        }
    }
</script>
