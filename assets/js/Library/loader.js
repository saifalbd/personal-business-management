saif.loader={
    parentClass:'loader-back-fixed',
    txtNote:'Please, wait...',
    defaultPosition:'fixed',
    currentLoader:null,

    close() {
        if (this.isOpen()) {
            this.currentLoader.remove();
        }
    },
    isOpen() {
        return this.currentLoader;
    },
    createTextNode(){
        let el =  document.createElement('div');
        el.setAttribute('class','wait-text')
        el.textContent = this.txtNote;
        return el;
    },
    createOverly(child){
        let el =  document.createElement('div');
        el.setAttribute('class','overlay '+this.parentClass);
        document.body.appendChild(el);
        el.appendChild(child);
        el.appendChild(this.createTextNode())

        this.currentLoader = el;
    },
    createProgress(type){
        let el =  document.createElement('div');
        el.setAttribute('data-role','activity');
        el.setAttribute('data-type',type);
        el.setAttribute('data-style','color');

        this.createOverly(el);
    },
    setPosition(){
        if (this.defaultPosition==='fixed'){
            this.parentClass = 'loader-back-fixed';
        }else{
            this.parentClass = 'loader-back-relative';
        }
    },
    position(position){
        this.defaultPosition = position;
        return this;
    },
    text(txt){
      this.txtNote = txt;
      return this;
    },
    openCycle(){
        this.setPosition();
        this.createProgress('cycle')
    },
    openSquare(){
        this.setPosition();
        this.createProgress('square')
    },
    openMetro(){
        this.setPosition();
        this.createProgress('metro')
    },
    openSimple(){
        this.setPosition();
        this.createProgress('simple')
    },


};