
    saif.activeInactivePayment=async function (_uid,role) {
        try {
            if (role==='active' || role==='inactive' ){

           return  await axios.get("/api/pending/"+_uid+"/update/"+role);
            }else {
                console.error('role must be active or inactive')
                throw new Error('role must be active or inactive')
            }

        }catch (e) {
            console.error(e);
            return e;
        }

    };

