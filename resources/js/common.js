export default {
    data(){
        return {

        }
    },
    methods: {
       async callApi(method, url, dataObj){
            try {
             return  await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
            } catch (error) {
                return error.response
            }
        },
        i (des, title="Hey") {
            this.$Notice.info({
                title: title,
                desc: des
            });
        },
        s (des, title="Great") {
            this.$Notice.success({
                title: title,
                desc: des
            });
        },
        w (des, title="Attention") {
            this.$Notice.warning({
                title: title,
                desc: des
            });
        },
        e (des, title="Error") {
            this.$Notice.error({
                title: title,
                desc: des
            });
        },
        swr (des, title="Oops") {
            this.$Notice.error({
                title: title,
                desc: des
            });
        }
    },
}