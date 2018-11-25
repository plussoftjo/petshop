<template>
	<div class="proudct">
		<v-btn class="success" @click="$router.push({name:'storeProudct'})">
			New Proudct
		</v-btn>
		<v-data-table
		 :headers="headers"
		 :items="proudcts"
		 class="elevation-1"
		 >
		    <template slot="items" slot-scope="props">
		      <td class="text-xs-center"  @click="$router.push({name:'editProudct',params:{id:props.item.id}})">{{ props.item.id }}</td>
		      <td class="text-xs-center"  @click="$router.push({name:'editProudct',params:{id:props.item.id}})">{{ props.item.title }}</td>
		      <td class="text-xs-center"  @click="$router.push({name:'editProudct',params:{id:props.item.id}})">{{ props.item.weight }}</td>
		      <td class="text-xs-center"  @click="$router.push({name:'editProudct',params:{id:props.item.id}})">{{ props.item.des }}</td>
		      <td class="text-xs-center"  @click="$router.push({name:'editProudct',params:{id:props.item.id}})">{{ props.item.price }}</td>
		      <td class="text-xs-center"  @click="$router.push({name:'editProudct',params:{id:props.item.id}})">{{ props.item.catg }}</td>
		      <td class="text-xs-center"  @click="$router.push({name:'editProudct',params:{id:props.item.id}})">{{ props.item.image }}</td>
		    </template>
	   </v-data-table>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				headers:[{text:'ID',value:'id',align:'center'},{text:'Title',value:'title',align:'center'},{text:'weight',value:'weight',align:'center'},{text:'description',value:'des',align:'center'},{text:'price',value:'price',align:'center'},{text:'Catgorays',value:'catg',align:'center'},{text:'image',value:'image',align:'center'}],
				proudcts:[]
			}
		},
		methods:{
			install() {
				const vm = this;
				axios.get('/proudct/index').then(response => {
					vm.proudcts = response.data;
				}).catch(err => {
					console.log(err);
				});
			}
		},
		created() {
			const vm = this;
			vm.install();
		}
	}
</script>