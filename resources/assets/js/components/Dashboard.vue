<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="row mt-3">
               <div class="col-md-4">
                   <router-link to="suppliers" style="text-decoration:none;color:#000;">
                   <div class="card1"><i class="i fa fa-users"></i>
                   <span v-for="supplier in suppliers" :key="supplier.id">
                       {{$supplier.id}}
                   </span>
                   <h5>Suppliers</h5>
                   
                   </div>
                   </router-link>
                   
                   
               </div>
               <div class="col-md-4">
                   <router-link to="orders" style="text-decoration:none;color:#000;">
                   <div class="card2"><i class="i fa fa-file"></i>
                   <h5>Orders</h5>
                   </div>
                   </router-link>
               </div>
               <div class="col-md-4">
                   <router-link to="products" style="text-decoration:none;color:#000;">
                   <div class="card3"><i class="i fa fa-briefcase"></i>
                   <h5>Stock</h5>
                   
                   </div>
                   </router-link>
               </div>
               </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                suppliers:{},
                form: new Form({
                  id:'',
                    name:'',
                    email:'',
                    phone:'',
                    address:'',
                    password:''
                })
            }
        },
        methods : {
           updateSupplier(){
            this.form.put('api/supplier/'+this.form.id).then(()=>{
              swal.fire(
                'Updated!',
                'Information has been updated',
                'success'
              )
              Fire.$emit('AfterCreate');
              $("#exampleModalCenter").modal("hide");
            }).catch(()=>{
              
            });
          },
          editModal(user){
            this.editmode = true;
            this.form.reset();
            this.form.fill(user)
            $("#exampleModalCenter").modal("show");
          },
          newModal(){
            this.editmode = false;
            this.form.reset();
            $("#exampleModalCenter").modal("show");
          },
          deleteSupplier(id){
            swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete Supplier!'
          }).then((result) => {
            if (result.isConfirmed) {
              this.form.delete('api/supplier/'+id).then(()=>{
                swal.fire(
                'Deleted!',
                'Supplier has been deleted.',
                'success'
              )
              Fire.$emit('AfterCreate');
              }).catch(()=>{
                swal.fire(
                'Failed!',
                'A problem occurred !',
                'warning'
              )
              })
              
            }
})
          },
             loadSuppliers(){
            axios.get('api/supplier').then(({data})=>(this.suppliers = data.data));
        },
            createSupplier(){
              this.$Progress.start()
                this.form.post('api/supplier').then(()=>{
                  Fire.$emit('AfterCreate');
                Toast.fire({
                icon: 'success',
                title: 'Supplier Added successfully'
})
                
                $('#exampleModalCenter').modal('hide');
                this.$Progress.finish()
                }).catch(()=>{

                })
                
            }
        },
       
        created() {
            this.loadSuppliers();
            Fire.$on('AfterCreate',() => {
              this.loadSuppliers();
            });
            // setInterval(()=>this.loadUsers(),3000)
        }
    }
</script>

