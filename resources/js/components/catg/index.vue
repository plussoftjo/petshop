<template>
	<div class="catg">
		<v-btn class="info" @click="dialog = !dialog" dark large>New Catgoray</v-btn>

		<v-container grid-list-md>
			<v-layout row wrap>
				<v-flex xs6 v-for="c in catgs" :key="c.id">
					<v-card>
						<v-img
						:src="c.image"
						contain></v-img>
						<v-card-actions>
							{{c.title}}
							<v-spacer></v-spacer>
							<v-btn icon class="primary" @click="() => {
								editDialog = !editDialog;
								catg = {id:c.id,title:c.title,image:c.image}
							}"><v-icon>build</v-icon></v-btn>
							<v-btn icon dark class="red" @click="destroy(c.id)"><v-icon>delete</v-icon></v-btn>
						</v-card-actions>
					</v-card>
				</v-flex>
			</v-layout>
		</v-container>
		
		<v-dialog v-model="dialog" max-width="500px">
			<v-card>
				<v-container>
					<v-layout row wrap>
						<v-flex xs12>
							<v-text-field
							label="عنوان" 
							v-model="catg.title"
							solo></v-text-field>							
						</v-flex>
						<v-flex xs12> 
							<v-btn class="red" dark block @click="openImageFile">Add Image</v-btn>
							<input 
							type="file" 
							ref="fileInput"
							@change="onFileChange"
							> 
						</v-flex>

						<v-flex xs6>
							<v-btn class="success" @click="store">
								حفظ
							</v-btn>
							<v-btn @click="() => {
								dialog = !dialog;
								catg = {title:'',image:''}
							}">
								Close
							</v-btn>
						</v-flex>
					</v-layout>
				</v-container>
			</v-card>
		</v-dialog>
	
		<v-dialog v-model="editDialog" max-width="500px">
			<v-card>
				<v-container>
					<v-layout row wrap>
						<v-flex xs12>
							<v-text-field
							label="عنوان" 
							v-model="catg.title"
							solo></v-text-field>							
						</v-flex>
						<v-flex xs12> 

							<v-img
							:src="catg.image"
							contain
							height="200px"
							width="200px">
								<v-btn class="red" dark  @click="openFile">Change</v-btn>
							</v-img>
							<input 
							type="file" 
							ref="file"
							@change="onChange"
							> 
						</v-flex>

						<v-flex xs6>
							<v-btn class="success" @click="store">
								حفظ
							</v-btn>
							<v-btn @click="() => {
								editDialog = !editDialog;
								catg = {title:'',image:''}
							}">
								Close
							</v-btn>
						</v-flex>
					</v-layout>
				</v-container>
			</v-card>
		</v-dialog>


	</div>
</template>
<script>
	export default {
		data() {
			return {
				catgs:[],
				dialog:false,
				editDialog:false,
				catg:{image:'',title:''}
			}
		},
		methods:{
			store() {
				const vm = this;
				axios.post('catg/store',vm.catg).then(response => {
					location.reload();
				}).catch(err => {
					console.log(err)
				});
			},
			install() {
				const vm = this;
				axios.get('catg/index').then(response => {
					vm.catgs = response.data;
				}).catch(err => {
					console.log(err)
				});
			},
			onFileChange(e) {
		        let files = e.target.files || e.dataTransfer.files;
		         if (!files.length)
		            return;
		        this.createImage(files[0]);
		      },
		      createImage(file) {
		         let reader = new FileReader();
		          let vm = this;
		          reader.onload = (e) => {
		              vm.catg.image = e.target.result;
		          };
		          reader.readAsDataURL(file);
		      },
		      openImageFile() {
		      	const vm = this;
		      	vm.$refs.fileInput.click();
		      },
		      destroy(id) {
		      	const vm = this;
		      	var id = id;
		      	confirm('هل تريد الحذف ؟') && axios.get('catg/destroy/' + id).then(response => {
		      		location.reload();
		      	}).catch(err => {
		      		console.log(err);
		      	});;
		      },
		      openFile() {
		      	const vm = this;
		      	vm.$refs.file.click();
		      },
		      onChange(e) {
		        let files = e.target.files || e.dataTransfer.files;
		         if (!files.length)
		            return;
		        this.createImagex(files[0]);
		      },
		      createImagex(file) {
		         let reader = new FileReader();
		          let vm = this;
		          reader.onload = (e) => {
		          	vm.catg.image = e.target.result;
		          	vm.updateImage();
		          };
		          reader.readAsDataURL(file);
		      },
		      updateImage() {
		      	const vm = this;
		      	axios.post('catg/updateImage/' + vm.catg.id, {image:vm.catg.image}).then(response => {
		      		location.reload();
		      	}).catch(err => {
		      		console.log(err)
		      	});
		      }

		},
		created() {
			const vm = this;
			vm.install(); 
		}
	}
</script>
<style scoped>
    input[type=file] {
        position: absolute;
        left: -99999px;
    }
</style>
