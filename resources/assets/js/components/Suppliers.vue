<template>
    <div class="container" mt-5>
        <button class="btn btn-success" @click="newModal()">Add Supplier <i class="fa fa-user-plus"></i></button>
        <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Suppliers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  @submit.prevent="editmode ? updateSupplier() : createSupplier()" >
      <div class="modal-body">
         <div class="form-group">
      <label>Username</label>
      <input v-model="form.name" type="text" name="name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
      <has-error :form="form" field="name"></has-error>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input v-model="form.email" type="text" name="email"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
      <has-error :form="form" field="email"></has-error>
    </div>
     <div class="form-group">
      <label>Phone</label>
      <input v-model="form.phone" type="text" name="phone"
        class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
      <has-error :form="form" field="phone"></has-error>
    </div>
     <div class="form-group">
      <label>Address</label>
      <input v-model="form.address" type="text" name="address"
        class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
      <has-error :form="form" field="address"></has-error>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
    
  </div>
  
</div>
       <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Supplier No.</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                       <th>Date Registered</th>
                        <th>Action</th>
                        </tr>
                  </thead>
                  <tbody>
                  <tr v-for="supplier in suppliers" :key="supplier.id" role="row" class="odd">
                    <td>{{supplier.id}}</td>
                    <td>{{supplier.name | textUp}}</td>
                    <td>{{supplier.email}}</td>
                    <td>{{supplier.created_at | customDate}}</td>
                    <td>
                      <button @click="editModal(supplier)"><i class="fa fa-edit fa-w text-blue"></i></button>
                    <button @click="deleteSupplier(supplier.id)"><i class="fa fa-trash fa-w text-red"></i></button>
                    </td>
                  </tr></tbody>
                  
                </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
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
