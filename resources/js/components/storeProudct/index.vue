<template>
	<div class="storeProudct">
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
				<v-btn class="red darken-2" dark block @click="picBtn">Add picture</v-btn>
				<input 
				type="file" 
				ref="fileInput"
				@change="onFileChange"
				> 
			</v-flex>
			<v-flex xs12>
				<v-btn class="success" @click="store" dark block>Submit</v-btn>
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
				catg:'',
				error:false,
				errors:null

			}
		},
		methods:{
			picBtn() {
				const vm = this;
				vm.$refs.fileInput.click();
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
		          };
		          reader.readAsDataURL(file);
		      },
			store() {
				const vm = this;
				axios.post('/proudct/store',vm.item).then(response => {
					vm.$router.push({name:'editProudct',params:{id:response.data.id}});
				}).catch(err => {
					vm.error = true;
					vm.errors = err.response.data.errors;
					console.log(err)
				});
			}
		}
	}
</script>
<style scoped>
    input[type=file] {
        position: absolute;
        left: -99999px;
    }
    .colorPlate{ display: inline-block; }
	.colorPlate input{ display: inline-block; }
</style>
