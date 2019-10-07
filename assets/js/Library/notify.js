
// CommonJS

saif.configNotify = {
    success:function(title,txt){
        Swal.fire({
            title: title,
            text:txt,
            type: 'success',
            confirmButtonText: 'close',
            allowOutsideClick:false

        });
    },
    error:function (txt) {
        Swal.fire({
            title: 'Error!',
            text:txt,
            type: 'error',
            confirmButtonText: 'close',
            allowOutsideClick:false

        });
    },

    errors:function (txt) {
        Swal.fire({
            title: 'Errors!',
            html:txt,
            type: 'error',
            confirmButtonText: 'close',
            allowOutsideClick:false

        });
    },

    
};
saif.notifyAlert = {
    getHasMessages:function(key){
        if (serverMassage){
            return serverMassage[key]?serverMassage[key]:null;
        }else{
            console.error('const serverMassage not found')
            return  false;

        }


    },
    startMessage:function(title,massage){
        if (massage){
            saif.configNotify.success(title,massage);
        }else{
            //console.error('massage are missing');
        }
    },

    errorsMessage:function(arr =[]){
        let key = 'errors';

        let hasErrors = this.getHasMessages(key)?this.getHasMessages(key):[];

        let texts = arr.length?arr:hasErrors;
        var result = '';
        texts.forEach((item,key)=>{
            result+= item+`<br/>`;

        });

        if (result)
        saif.configNotify.errors(result);

    },
    fromErrorsMessage:function(arr =[]){
        let key = 'formErrors';

        let hasErrors = this.getHasMessages(key)?this.getHasMessages(key):[];

        let texts = arr.length?arr:hasErrors;
        var result = '';
        texts.forEach((item,key)=>{
            result+= item+`<br/>`;

        });

        if (result)
            saif.configNotify.errors(result);

    },
    restFromErrorsMessage(e){

        if (e.response && e.response.status===422){
            const res = e.response;
            var errorIs = new Array();
            // console.log(typeof  res.data.errors)
            if (res.data.errors && typeof res.data.errors === 'object'){
                Object.values(res.data.errors).forEach((item)=>{
                    if (Array.isArray(item)) {
                        item.forEach((list)=>{
                            errorIs.push(list)
                        })
                    }else {
                        errorIs.push(item)
                    }
                });

            }else{
                errorIs.push(res.statusText);
            }
            saif.notifyAlert.errorsMessage(errorIs);
        }else {
            console.error(e)
        }
    },
    errorMessage:function(txt = null){
        let key = 'error';

        let text = txt?txt:this.getHasMessages(key);
        if (text)
        saif.configNotify.error(text);
    },
    createMessage:function(txt = null){
        let key = 'created';
        let title = 'created';

        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);

    },
    successMessage:function(txt = null){
        let key = 'success';
        let title = 'success';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    updateMessage:function(txt = null){
        let key = 'updated';
        let title = 'updated';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    uploadMessage:function(txt = null){
        let key = 'uploaded';
        let title = 'uploaded';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    removeMessage:function(txt = null){
        let key = 'removed';
        let title = 'removed';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    addMessage:function(txt = null){
        let key = 'added';
        let title = 'added';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    getServerMassage:function () {
        this.fromErrorsMessage();
        this.errorsMessage();
        this.errorMessage();
        this.createMessage();
        this.successMessage();
        this.updateMessage();
        this.uploadMessage();
        this.removeMessage();
        this.addMessage();
    }

};



