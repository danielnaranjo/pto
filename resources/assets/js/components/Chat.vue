<template>


                            <!-- saliente -->
                            <div class="m-messenger__message m-messenger__message--out">
                                <div class="m-messenger__message-body">
                                    <div class="m-messenger__message-arrow"></div>
                                    <div class="m-messenger__message-content">
                                        <div class="m-messenger__message-text">
                                            Hi Megan. It's at 2.30PM
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- saliente -->

                            <!-- entrante -->
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
                            <!-- entrante -->

                            <!-- fecha -->
                            <div class="m-messenger__datetime">2:30PM</div>
                            <!-- fecha -->


</template>

<script>
export default {
    mounted() {
        console.log('Chat mounted.')
    },
    data() {
        return {
            list: []
        };
    },

    created() {
        this.getChat();
    },

    methods: {
        getChat() {
            axios.get('/api/message/1').then((res) => {
                this.list = res.data;
            });
        }
    }
}
</script>
