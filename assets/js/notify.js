
// CommonJS
const Swal = require('sweetalert2');
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
        return serverMassage[key]?serverMassage[key]:null;
    },
    startMessage:function(title,massage){
        if (massage){
            saif.configNotify.success(title,massage);
        }else{
            //console.error('massage are missing');
        }
    },

    errorsMessage:function(arr =[]){
        let key = 'errorsMessage';

        let hasErrors = this.getHasMessages(key)?this.getHasMessages(key):[];

        let texts = arr.length?arr:hasErrors;
        var result = '';
        texts.forEach((item,key)=>{
            result+= item+`<br/>`;

        });

        if (result)
        saif.configNotify.errors(result);

    },
    errorMessage:function(txt = null){
        let key = 'errorMessage';

        let text = txt?txt:this.getHasMessages(key);
        if (text)
        saif.configNotify.error(text);
    },
    createMessage:function(txt = null){
        let key = 'createMessage';
        let title = 'created';

        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);

    },
    successMessage:function(txt = null){
        let key = 'successMessage';
        let title = 'success';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    updateMessage:function(txt = null){
        let key = 'updateMessage';
        let title = 'updated';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    uploadMessage:function(txt = null){
        let key = 'uploadMessage';
        let title = 'updated';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    removeMessage:function(txt = null){
        let key = 'removeMessage';
        let title = 'removed';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    addMessage:function(txt = null){
        let key = 'addMessage';
        let title = 'added';
        let text = txt?txt:this.getHasMessages(key);
        this.startMessage(title,text);
    },
    getServerMassage:function () {
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



