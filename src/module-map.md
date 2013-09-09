# 核心模块列表

<table id="module_map" class="table table-bordered">
<thead>
	<tr>
		<td>
			模块名
		</td>
		<td>
			模块说明
		</td>
		<td>
			别名
		</td>
		<td>
			模块依赖
		</td>
	</tr>
</thead>
<tbody>
	<tr>
		<td>
			模块名
		</td>
		<td>
			模块说明
		</td>
		<td>
			别名
		</td>
		<td>
			模块依赖	
		</td>
	</tr>
</tbody>
</table>


<script>

var des = {};

KISSY.use('node',function(S){
	var tb = S.one('#module_map');
	if(!tb){
		return;
	}

	var tbdy = tb.one('tbody');
	for(var i in S.Env.mods){
		var n = i;
		var r = S.Env.mods[i].requires ? S.Env.mods[i].requires : [];
		var a = S.Env.mods[i].alias ? S.Env.mods[i].alias : [];
		var d = des[n]?des[n]:'';
		var str = '<tr><td>'+n+'</td><td>'+d+'</td><td>'+r.join(',')+'</td><td>'+a.join(',')+'</td></tr>';
		tbdy.append(str);
	}

});

</script>
