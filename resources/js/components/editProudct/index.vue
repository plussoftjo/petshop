<template>
	<div class="editProudct">
		<v-layout row wrap>
			<v-flex xs12>
				<v-alert
			:value="error"
			class="red">
			<span v-if="errors" v-for="err in errors" :key="err">{{err[0]}} <br></span>
			<span v-else>There Are Error In Network</span>
			</v-alert>
			</v-flex>
			<v-flex xs6>
				<v-text-field
				v-model="item.title"
				label="عنوان"
				solo></v-text-field>
			</v-flex>
			<v-flex xs6>
				<v-text-field
				solo
				label="وزن"
				v-model="item.weight"></v-text-field>
			</v-flex>
			<v-flex xs6>
				<v-text-field
				solo
				v-model="item.des"
				label="وصف"></v-text-field>
			</v-flex>
			<v-flex xs6>
				<v-text-field
				solo
				label="سعر"
				v-model="item.price"></v-text-field>
			</v-flex>
			<v-flex xs6>
				<v-select
				:items="catgs"
				solo
				v-model="item.catg"
				label="النوع"></v-select>
			</v-flex>
			<v-flex xs6>
				<v-btn class="red" dark block @click="submitMoreImage">Add More Image</v-btn>
				<input 
						type="file" 
						ref="moreImageInput"
						@change="fileChange"
						> 
			</v-flex>
			<v-flex xs12>
				<div class="onBlock">
					<v-img class="mr-3" heigth="200px" width="200px" style="max-width: 200px!important; max-height: 200px!important;" :src="item.image">
						<v-btn class="blue darken-1" icon dark @click="clickEditImage"><v-icon>build</v-icon></v-btn>
						<input 
						type="file" 
						ref="fileInput"
						@change="onFileChange"
						> 
					</v-img>

					<v-img heigth="200px" width="200px" style="max-width: 200px!important; max-height: 200px!important;" v-for="(mi,index) in item.more_images" :key="index" :src="mi.image">
						<v-btn class="red darken-1" dark icon @click="deleteImage(mi.id,index)"><v-icon>delete</v-icon></v-btn>
					</v-img>
				</div>
			</v-flex>
			<v-flex xs6>
				<v-btn class="success" @click="update"  dark block>Update</v-btn>
			</v-flex>
			<v-flex xs6>
				<v-btn class="red" dark block @click="destroy">Delete</v-btn>
			</v-flex>
		</v-layout>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				item:{title:'',weight:'',des:'',price:'',catg:'',image:''},
				catgs:['Dogs','Cats'],
				error:false,
				errors:null,
				image:''
			}
		},
		methods: {
			install() {
				const vm = this;
				axios.get('proudct/show/' + vm.$route.params.id).then(response=> {
					vm.item = response.data;
					console.log(vm.item);
				}).catch(err => {
					console.log(err)
				});
			},
			editImage() {
				const vm = this;
				axios.post('proudct/updateImage/' + vm.$route.params.id,{image:vm.item.image}).then(response => {
					vm.item.image = response.data;
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
		          		vm.item.image = e.target.result;
		              vm.editImage();
		          };
		          reader.readAsDataURL(file);
		      },
		      clickEditImage() {
		      	const vm = this;
		      	vm.$refs.fileInput.click();
		      },
		      submitMoreImage() {
		      	const vm = this;
		      	vm.$refs.moreImageInput.click();
		      },
		      fileChange(e) {
		        let files = e.target.files || e.dataTransfer.files;
		         if (!files.length)
		            return;
		        this.filecreateImage(files[0]);
		      },
		      filecreateImage(file) {
		         let reader = new FileReader();
		          let vm = this;
		          reader.onload = (e) => {
		          		vm.image = e.target.result;
		              vm.moreImageUpload();
		          };
		          reader.readAsDataURL(file);
		      },
		      moreImageUpload() {
		      	const vm = this;
		      	axios.post('proudct/moreImage/'+ vm.$route.params.id,{image:vm.image}).then(response => {
		      		vm.item.more_images.push({image:response.data.image,id:response.data.id});
		      	}).catch(err => {
		      		console.log(err)
		      	});
		      },
		      deleteImage(id,index)
		      {
		      	const vm = this;
		      	var index = index
		      	confirm('هل تريد الحذف ?') && axios.get('proudct/deleteImage/'+id).then(response=> {
		      		vm.item.more_images.splice(index,1)
		      	}).catch(err => {
		      		console.log(err)
		      	});
		      },
		      update() {
		      	const vm = this;
		      	axios.post('proudct/update/' + vm.$route.params.id, vm.item).then(response => {
		      		location.reload();
		      	}).catch(err => {
		      		console.log(err)
		      	});
		      },
		      destroy() {
		      	const vm = this;
		      	confirm('هل تريد الحذف') && axios.get('proudct/destroy/' + vm.$route.params.id).then(response => {
		      		vm.$router.push({name:'proudct'})
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
	.onBlock{position: relative; display: flex; overflow-x: scroll;}
    input[type=file] {
        position: absolute;
        left: -99999px;
    }
    .colorPlate{ display: inline-block; }
	.colorPlate input{ display: inline-block; }

</style>