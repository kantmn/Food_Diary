<? include_once('../func/css_loading.php'); ?>
html, body{
	border:none; padding:0; margin:0;
	border: 0px solid purple;
	padding-top: 25px;
	color:#202020;
	font-family:"Roboto",sans-serif;
}



a, a:active, a:visited{
	color: #999;
	text-decoration: none;
}
a:hover{
	color: #111;
	text-decoration: underline;
	-o-transition:.5s;
	-ms-transition:.5s;
	-moz-transition:.5s;
	-webkit-transition:.5s;
	/* ...and now for the proper property */
	transition:.5s;
}
h3{
	margin: 10px 0;
}
div, ul{
	padding: 0px;
	margin: 0px;
}
table{
	border: 0px solid green;
	margin: 0;
	padding: 0;
	display: block;
	margin: 0 auto;
}
tr{
	
}
body:not(.night) #filter_table tr:nth-child(even){
	background-color: #cecece;
}
body:not(.night) #filter_table tr:hover{
	color: #23be63;
}
th{
	border-bottom: 1px solid #333;
	white-space: nowrap;
}
td, th{
	padding: 1px 3px;
}
td.cell_top{
	vertical-align: top;
}
#filter_table td.row_food{
	overflow: hidden;
	text-overflow: hidden;
}
td.row_food{
	word-wrap: break-word;         /* All browsers since IE 5.5+ */
	word-break: break-all; 
	overflow: hidden;
	overflow-wrap: break-word;
	text-overflow: hidden;
	white-space: normal;
}

.stats_data_row:nth-child(2){
	white-space: nowrap;
}
.stats_data_row{
	white-space: nowrap;
}
.textblock{
   overflow: hidden;
   display: -webkit-box;
   -webkit-box-orient: vertical;
   -webkit-line-clamp: 5; /* number of lines to show */
}
.icon{
	width: 32px;
	height: 32px;
}
.icon_filter_gray{
	filter: gray; /* IE6-9 */
	-webkit-filter: grayscale(1) opacity(30%); /* Google Chrome, Safari 6+ & Opera 15+ */
	filter: grayscale(1) opacity(30%); /* Microsoft Edge and Firefox 35+ */
}

.green_success{
	color: green;
	text-indent: 25px;
	background-repeat: no-repeat;
	background-position: left top;
	background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAADLElEQVQ4T42UX0hTURzHr6lFD733Mpdzrc3QVhKBBZJIDgOLypcgeih66MF8iCAKFlpCj7Ld/XEr1LByWYFoFDbvn206yT+R81+6JMUKEWer6cxtv845997tzlZ04Mv53XN+5/P7/c6551CZmitQs73VW1Fl4wsdNk+h/4Gv5JPTpw+09B91t/nLnrb7KivtQ1dyRfe/N6OR2mbpK660cHsDZi4PzGwemJCwbRKFbQtfAC39pdMd/uqTAFSWuDy9MUxZjo0rvosgcWnhVpB8HAuBo62+8kYX1GSLGKHhKDSrq8fZmDhFEiKHSZKPCX1+/OXw+ccMY8wRcRRlcReXI1hMvvDfUgI/YwRfsBGavfvB5tFC1/tLtQTW9Mqwg2bVU+lRU7aUsRzWOXIa5pbfwuraHDx5dwKNKaDNfyzcHbi+m7J79BUpZ0ECSLRZRXIMH0bvxDVYjczBYsgPjwbLZMFQoOEztyia3dcmgeRKzwrDVNAzdhk+L7Ow/msFlXsvbR7L7ilyUxZOPSMflDKSi+ZUwEzfhIUVH3wJDcKzkVMkAC5V2BJhW2y8bh5lqPqRCSLJwqthIHgfVn7OwnJ4Au2ZIaMflpXXhCiaKfguDdDcHtQriY2D0Fw+jM43Qyy2AaFIkGQm+UrC2Um2hVUvUlZWO2Qmi5XQPXYRPn7rgr6pG+QAAovtEE9swtrGEjwfPSsCUpD0fVYgoMZPWTltkzRo9+hg8msnxOJRCC69gUQiBpHoErwev4rmU5knT15m46QQ6yHl9B46TiZxVHRTWgaOwFI4gGBxCK8vgHemgZROFssgaRLXO3h9LWUfKsmlGZXwGIgTvZN1pMwPC63iaUpliUDiJ/hK5Zu5PZsvhi/oyG2xMQcNJlaZvHoOXxF4Z+vRldIkQZmE4cRGlVlZjZXASEOPg5UtbED3OZFy3rJIpmSpJFt0oKya6+g/t1OkCc3lqsl2eA7cQaWQTCWQHChByDex0a/GqHuc3tJdIuaPluXgDxvQzz6ehIh96htnhe38kI0puv1fLzfJ1q2vwvcclTNtZlUR9IpHUT+P/rVuC6Otc3qrM2RFUb8BshRqrRQ8Cc4AAAAASUVORK5CYII=');
}
.red_error{
	color: red;
	text-indent: 25px;
	background-repeat: no-repeat;
	background-position: left top;
	background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAADpklEQVQ4T31U7U9TVxi/0FZeFCsdtGtLY0JBhUwsOv2gGLI5lDFNagKKS9QoW7d92AcSXeLi0sQPwv4B42KWjGTJMv2wxC/7pH7YBxTpyz2nL1xECmJ15UVrFUpb6m/nXO+tt4J7kl9y7zm/5/c8z3nOc4S17E57e/ldu+UTv93+Y9DhEKMHD0rhHS3/Rl2uiNjQ8NfIx629j/r7KxT6+w1ebyk9d84pHTsmUb0eRFcKUlICwrZUUIMB4epqkO3b//EfOvQZgBLFvdjGOzvLSH3DUNhqTRG9DlTHwAUUhDTfPEiksRHhrVvT4s6dX7OK9IrMG0NPjy5oMv1CKytk8nR/P55evQpaWbmmoNTWhhQhIDU1CJnNebp376+4fl2nyAnCSHd3OzEaX8vRjUYkAwGkJAkzFy7IAVQhjrFdu5BJJBAfuFw4hlBVFQJ1dedlsTterz7Y1vYbZY5qFvFLl7CcfI7siyQmT55ka8repk1Ix2JYWU5jzOV6mzU/gi1bFoc/PWIRAidOuKnZnNVmEXE6kZmbQy6TQe7VS0j79slnmrh2Dfl8Ho8v/lTgqgjX1sLX1HRRoC0tMVJauooQO3MG2VQKK9mMnFXM40F+JYfk8DDoBzVFXLl0rrF585ggfmiJqhu8BG0Zse++xWL8MfK5HFZYtumpKYTr6lZzlW9SY4oLoybTrJZQRGRR44ODSM8m8JqVOnn6VEHgXR/+f6+6ekYImEx5dVNLVjH+RRfLMMualMT8jRtFV0lFQdTpzAuk1bWgjVJE2LABi9EIlqYm8ZJSvJqexsTRo/JxqBwtRHMtFcbc7tvaaCoI62r850HWlCwe9vXhQVcX0vNzmL91C2GbbRWfw280/in4Ozo+J+vWvZlTDR643cgtLWHh5k25g/yCPxkYwBITfXLlihywyIdxfA7bcWH08OHKoMXyUL31HCGHAylKsDw3i0jTtsI6rahAYmgIz30+THzVB1HjI1ZtDI16PAZ5WkLNzZ2iTpdRNyNsvPikPPrhfMFBBZ+WKXYnx3t7Qdevl9eCOv0Lv8u1WxbjBkEoIY2N37PScpzAD57fQaJ0VBbSgpXHRg2EzTDzWb5vtX6pSL01Lhq02c7SsrJFys6Ud7JIhEHbUS4aNBieBez2Hua+9pvIbaSlqZU9S7dpeXlOFZUFtGIGwwLL7g+fs7lBcft/87KX++/9+63SgQOeaEeHFNqzOx6qr58R7fbffTs++ibOGqlQ3zFB+A/cCt7jNxSwYwAAAABJRU5ErkJggg==');
}
.row_food{
	overflow: auto;
}

.green{ color: #009933; }
.orange{ color: orange; }
.red{ color: red; }
.black{ color: black; }
.text-center{ text-align: center; }
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto;
  padding: 0px;
}
.grid-item {
  padding: 10px;
  font-size: 15px;
}
.feel_0{
	background: #009933;
	color: white;
	/*text-align: center;*/
}
.feel_1{
	background: #ffcc00;
	color: #333;
	/*text-align: center;*/
}
.feel_2{
	background: #b30000;
	color: white;
	/*text-align: center;*/
}
.feel_3{
	background: black;
	color: white;
	/*text-align: center;*/
}
#tabs_header {
	position: fixed;
	z-index: 9999;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 39px;
	text-align: center;
	margin: 0;
	padding: 0;
	background-color: #333;
}
#tabs_header div#account{
	float: left;
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAADP0lEQVRYR72WTWtTQRSGk9YvBHHjDxAVlLgRgiRtQoOCUFHcdSNY8Q9IiSSFQkgX0paAiBAoupHEurSCWtwUEcGmadKUNhHJRm1IbEK+mrQV/Gp833bSS+m96Vwh94HLndw5c86bmTNzxtRoNEwyuFyuA6FQ6HI0Go3Mzc2V4/H4j1gsxmcD33L4/XZyctIO047tEa1h3K3YMgIsFsshv99/t1wu/4G9JoVC4dfo6Ogdq9V6UAzVBObSAszDw8Pu1dXVvwyyHxQ5MjLSL8ZqAlM5ARMTEz3FYvE3ncsyOzu7jFk4LlyoAjM5AVjjd3SqB+aHw+G4IlyoAjM5AUwwOtVDrVbb9Hg8D4ULVWAmJwAzsE6nesEyJIULVWAiJ4DTSYd6gYBPwoUqMJETgD1foUO9QEBcuFAFJnIC4OgzHeqBW3ZoaMgnXKgCMzkBi4uLz+hUD8ibend391nhQhWYSQs4t7KyskHHsjAB+/r6OoULVWAmJ4CMj49fzefzP+l8Pyg2HA67xFBNYCovgAQCgZvZbHaNQdTg3sc/Xw4GgzfEkJZgiD4BwAzn11gN8XzH9lwXFbEWiUS+DA4O3nc6naeE7b5ICUAF7Ojt7T2Mpnn7i8mM5DqGQJaurq4etC/hyLXbbLaTrJjChnQiB/i7OW4PLQWgkBxFWb3NZMKT8Xq9D3AfOCK6W8IihGP4McZ9xawE7Hb7GbWEVBXASwfW+hYGZyuVyk7t5/pi2r/xQqKV3bwDYImuc3lo3xyHg2wN/qK4rFyE2c6MoHu3AAb3+Xz3SqWSZullracQrPv7RCLxcmFh4QXy4DW+RRGoUK1WNe8MuVxubWpqyroVDODTbgFYz9NUT+N2gZmIN29L+LlbwNjYWH+9Xt+aunaBI3pzZmbm/B4BzGBM4QcatZulpaUw4pvRVARwa2F6lmnQbhAnsUcAEvDE/1489II8y/N8QVMRwLO7uXXaDU9QniloKgLS6fQjdhoB7wrT09MX0FQEJJPJp+w0ikwm48dLETA/P/+KHUaRSqWe4KUIwBb8yA6jQB68wUsRgMxMssMoEC+GlyKA9ZwdRoGzII2XImBgYOA5VFWNetxud2hbQMP0DylOK511NdRnAAAAAElFTkSuQmCC');
	background-repeat: no-repeat;
}
#tabs_header div#tabs_activate_insert{
	background: url('data:image/png;base64,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');
	background-repeat: no-repeat;
}
#tabs_header div#tabs_activate_evaluation{
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAADq0lEQVRYR8VXS09TQRhtFRBNAP+CiQsWutc9P8AdaohidO8CXyixGE1EN5r4SFpIWJC6QKPUViMVQwQCUmlCCI+WN5Q3lPJILY+24zmXuaaF3vbWFDjJTe98M/Od830z882tQQhxqE9C40E+GUdLS0u1z+cTk5OTyjMxMSHGx8fF6Oio8stnaGhIzMzMDM/NzZ2T0zKH5ubmrIGBgY+ILiUgJiSnZRbwbaSIaDS6w6QBZkNOyTzMZnN2qkzsqwBiYWHhoeRKiH0VEAgEbh3aEiwvL5enIif+S0B9ff1R+ZoQq6urt7XIw+GwiO1bXFxMTwDO7Q1sLAdE5EhTHECumfbNzU3R2tpa2dfX91maxMrKin4Bs7Oz17a3t+E/Kjwej8NkMh2RXQrW1tbuaJFvbW2Jjo6OuxyHeVkI5AvtEKxPAKrWFZArzlR4vV67mon19fWbSSKPdnZ2VnBcXV1dPn+7urqyl5aWHLoyMD09fZ2RS39xGB4etsHJPS1yrrnL5bpPP9iYBSjNPxSnQG9vb87IyMg72UwMRF6iRZ4KkUgkilQ/oB8cyZOhUKgbKfcpjvUA5Fd3p10vQM7LxiRdGYLB4FfadQuA8hKkL6J4SxMkn5qaUta8qqqqACbjxsaGi326BGDNL2lFzrXmumoBfVGclkf0w7SPjY25eScg/YoAnJTkAuRuTxg5yf1+/8uenp7HiUTEph07PB9R/8ZdIChAzUBSAVBenGzDIX1v8GPEUCN28HMSquA7MldJPzU1NXmI2E27bgGI7LIWOSMH+Vs59B/6+/ufMROS/AltKDInrFZrIaseoUsAyC/CkWbaQf4Kr8b29vbjbW1t5/HFc6GxsfEMphpRVp+qkTPt6PelLQBOPmgVEpCbOWZwcPAYLg4nvuXKsFSlEO232+0UoUCuuQvV8U/aAjgABHFfLhSEwa/Zz8hB0EQ7CBQBfEdlCzidzrMNDQ15IPxFm8fjSV8Agb4jmGzjIAKRW/DDDWeYn58v37HGCyBwzJocDkeRbLI/WFtbm74Agl+zqO2fQF7NNpzn2my206j1FYo3AFdxnABsxO5YAcjc+2QCcGlpCyA4GOOMEJOLNf+OrBTHCtidAZycFxkVQPCKRdqV2o0NukcA+nQL4BdPWgIwmZF/U2YDuwXwFOyrAIvFcgo1PIyBHCzcbncxLqYKtY0yXIa9Uaq2celYcQqK1DaW5ycIC3FClDb/ljEo2L3YgAK+9gqAsEN9EhoP7hGGv12WECTbBjNDAAAAAElFTkSuQmCC');
	background-repeat: no-repeat;
}
#tabs_header div#tabs_activate_statistic{
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAADzUlEQVRYR8WXW08TURDHMRo/gjw1FRVIGo2YyIMv9hPoR/GNIC/6gppITPDBNBqp1hA0kCAaFCgttBDaAgmQ2AstbW0roTfbCgUkEVj/szu9sW26mybwS052e2bOnNk5M+ecNgmCcKataudpNtVgkGZra6vLZrONmc1m7/T0dNpqtW6j7eI9MzU19dNisdjdbvfz/f19LQ9rHJrY5/M9WV9fT+NdEZFI5O/CwsJgw44EAoGrHo/Hz3ZVEwwGdwwGwx02p47x8fEbGxsbf9hWkUwmc4wliCDcc7Ozs1/RxtDMWAIPlugfqxVJJpNH3d3d99msMrCOrRRGtiGSTqePMKltdXW1jdVkUMhdLte7k2Oz2eyxYiegr/H7/RXrTaE0mUy3WaUu0Wj0CpbOy8NFEonE4fDw8C1WqY3dbv/MY0TgTI4MslgxGKrxer0OyYoE2cJDwypyFhcX21Op1JGkLmVzrcmNRmPnysqKAUvyKpfLtXB3BTChORkJLJGRxXJmZma+s54ISq+XRTKQeFZWE/L5/APulkEfgHbAqkI4HN7FQx4FSqByRUyewqNmuJQ6QDidzvesKoKcesyiErFY7CHLRdbW1l6yqCpqHKCPi8fjxRJFNVlZVAJefmC5WHJY18ssqooaBwjsEz9YXcB7kLtLYP0tLBew0SS4uyZqHYD9b6xOEfjdhJrs2Nzc7Co0ZGuI5QLtgOWyoaEhWf2qdWB+fv4Tqws4vPIUEg//rgt0f8HGecmURLkDqG9nrVIsIHMASdGCUy7OfTWhaNChxHaKIGcGWUUESbwHey/wWvUELC9xcQkIcgLlluR+GZh8u9rkBMTaUCjUi7rekbQlEI3YxMTETVYrgrxys0plElK2c81XQPt/rcnLgaoW0fiIHfRQGikI2M4PmpubL7FKoQyLclxiLCySoEiUH0D4sjy22VYWKwJJ3IYPCdN4TJBG1zlJIi6XSTTM4OMesagEbZmTk5NhKsGlpaV27lYFbGuxbM/6+/v13CXbiunj8Ki+w+r1+gs6ne4i/2wYmujkjQqH0VsW1wf6muXl5de4oFzjLsXQWEzuEmdlkFNZPGofx+WQIspqjgZS2AYGBjpZVBcKO5z20dgCdCEZHR3tYJX6IA/e8FiRwpUMGa5jFRmUzHTyNXQlK0CXE4SMbjAVkDHUcRTOzOE/whfsiIVLqZe+ktWKUF9PT889NqsO+iKUlB17xTHbUwXtoiMjI/XvgfXo6+u7ixINKHUES7DncDjoeFeWcEqBE9fr/DWzIXGfKpoYSmfaqnaeXhOa/gNv6mYE27go3gAAAABJRU5ErkJggg==');
	background-repeat: no-repeat;
}
#tabs_header div#tabs_activate_chart{
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAAByUlEQVRYR82VTStEYRTHhxnjPaWU+AC2UspHsLBTUj6DlTAoNsrK0sLClg+h7OzUrJHI1oISo4x7/c69f2OueRrX23P96zfPec4585x/c18mF4ZhpjiTPnEmfWIfYRAEZejMZaG0Bqh309qm7e8pjQFq7bAHy7QXlP4dfWaAcg+1XfVVZCKv8s+lg50GKLWQn4IX6zMRV2GDsKi2n0mHOg2QG4ML66kXOfsllghT3RP0FQxtk9KBDQbY98Op1V2i9ghmounloKcXdmDL2avDEgaI7abbt1oz0fMC64QNvwS5VmoDcACmI2hX+V06qGaAbZF4DSpW+0z0PcEiYc0EsQ0fgTOoqu8ShtTyLhVrBlgnIdXwN9H/AAuEebDh03ATFetEbiIaWi8VIgMwDMdR9xfF955ZSqwzrHdR8oOoHbAknx4VyixdrJsQWO474qt2Oe61bRC1K5Y+jY6lwpuBbdv/lTj/FsY1OpYKXgyYmDGv0bGU9GngkKVD4/0bkAY1PhsDzJnV+MwM2Fs2fi0r4fsSnED8ONouAwOmUZeBVTj3xFzCANir2P4Fu33A2MQ9cA0rhCXfRAay1L8wkCnOpE+cSZ84k/4Ic6/QTGvJ02XywAAAAABJRU5ErkJggg==');
	background-repeat: no-repeat;
}
#tabs_header div#menu{
	float: right;
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAAEv0lEQVRYR71XbUybVRQuRh3qpjO6Zc7FGLfM+EezHyYmLuGX2bLFaGL4g424KhDEgoZgyBLEjDD+QAhhIZFCGBA+rIHwA8EAlvItCd8lgOX7w/INhY5Coe2757w9t7SObdBWnuTk3veec+8995xzz7mvwl9UVVX9GRYW9ip/Hj+2trbm9Xq9ITIy8hUeOl5YrdZ5u90utbS09EOJF3n4/0NERMTFrq6uq52dnWHl5eV5FovF6nQ6JVJCp9P1R0dHB94dWq32+ba2tmvt7e1DMLltb29Pcjgc8qa0OfVF29TUZFCr1S/zVP9RWFh4bWZmZoQ2ExsJ8vymPhFcIpWUlHzK032HSqU6tbS09MP29rZ78f/Szs6ObAXqkxJwh72np+dbXsKNqKioN7l7OCQnJwfD5C1iYbEhnc5kMg12d3enJSYm3pqcnDwNBRd48z246Ctewg3MUY6NjT3Iysq6wkNPBxb6g04mfEzt+Pj4cFFR0ecs4gbdAmwuQeFbPOSGzWZTIl6cpDzmmymWmPV4YPPvPYOMzNzb25sVHh4ezCJeWF9fn8Ocb/jTDaPReGJzc3NNWJDWmpiYqH/cOjIqKioubGxs7IiT4wQOg8HwE7MPRHV19XXuPoKOjo73oYRFKIH1JIwpmf0opqam7pKgoNbW1g5m+Yzi4uIoCmRSgmhtbc3ELG/ExMS8tri46KTT0+boP0CeP8Vsv4Cb0U5rkgLk3pqaGjWz9lFXVxfheXoElYZZfiMpKeljYQU6IG7PX8zaB9LoADGJyFfZ2dnnmeU3JEkKWllZ0Qs3LCwsrONanmC2C0ihX46OjmrBNCHXSzwcMNTW1v7u6Qa0LzDLG6GhoScLCgrO8WfAgCv4mbAAUWxsbDyzjgfT09Of0MYEalNTU39m1vEAMeClQEJCgrcCMPsXjY2Nf1dWVqoGBwdP4nHxHLMCArwd7osYoDYnJ+css1xoaGioElcQ2VCanZ019PX1pSB4brKIz0Bxe2ZoaMhd3JBjJKTv/SCk0yJD/UNMoSG1dCUxLsF/v7DooZGXl6fJz8+/Sn0ocBalXV6TCOlZJwsJ1NfXv0Wnpo2Fj6iPMtoJU33EYkcCrBe9u7trRSErhBVLxKGIsN89FnMBAl+LFCw2p29kQxWLHBmZmZnvQgF5HVpPEA7qQBK6wGIuwB8NlBzMZrMVkxw0iQjpc4MqGosdCfSoQUl2V0LRouBVsIgLsHjQ3NycBUGiLS0tPY8N9WICEWLAgheQT0oMDAzIgU2HEevR+wKK6eLj4z+UhfCCPaPRaG7IH0B6evrrENikiUIRCsTm5uY7cXFxp1nsUEDV+87TBaIPS0vDw8P9iI+D18vIyPgAVjELzaklQlDaYKkfYZFL+D94g8UVSqXyJTzXLiHyb6OIXeZhRUpKykWc2I6opwI0j7m/5ebm3ka+CQ4JCXmWxQ4Gov8KJliFFcQpiOhxurq6iqegxYgnmRHtv2hlHn7TvHI8LHoXye0y1RgeOjxIU5ipnB6dQpEnEcmg1lfz9MAB9/YduESLU24LP9KGnqAxIljNjhvwZPP6irS0tLfhZ/XIyEgBbss8YoFezBSg0vLy8n3Uk1/Lysreg2iQa8bToFA8BPVxBBdAmakjAAAAAElFTkSuQmCC');
	background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuMjHxIGmVAAAAzElEQVRYR+2XPQ4CIRBG5+xaeQSP4DU8gpews4BCCH/ON6KJybbOtwUvGRZo3iwZdkHGGNTYnPQMa1prB417rXV4BFxwWgLaOWqHAtyiGT3m2B24sQJpjt2BGwlc5tgduD9FeH1P+TGd8iXG6BqLxQ8p2XY89d7PHgEXnEYphfIxghNuyG9zzh24RZekz7E7cPNXgFUD+vJPqwFA3QWLBdCilJzz5n/7HwEXnEYIATuAciKCG3LumVAb7ql4D/cC7s1In0iCdzdEw4shLxLS+RlV8CEPAAAAAElFTkSuQmCC');
	background-repeat: no-repeat;
	background-position: center right;
}
#overlay_navigation{
	right: 0px;
	border-bottom-left-radius: 25px;
	padding-right: 20px;
	padding-left: 45px;
}
#overlay_account{
	left: 0px;
	border-bottom-right-radius: 25px;
	padding-right: 15px;
	padding-left: 20px;
}
	
#overlay_navigation,
#overlay_account{
	position: fixed;
	display: none;
	font-size: 1.5em;
	max-width: calc(100% - 65px);
	top: 39px;
	z-index: 1;
	border: 0px;
	padding-top: 5px;
	padding-bottom: 15px;
	background: #333;
	color: #fff;
	-webkit-box-shadow: 1px 1px 8px 5px rgba(0,0,0,0.75);
	-moz-box-shadow: 1px 1px 8px 5px rgba(0,0,0,0.75);
	box-shadow: 1px 1px 8px 5px rgba(0,0,0,0.75);
}
#overlay_account > ul{
	margin-left: 15px;
}
#overlay_navigation ul li,
#overlay_account ul li{
	margin-bottom: 10px;
}
#overlay_navigation ul li a,
#overlay_navigation ul li a:visited,
#overlay_account ul li a,
#overlay_account ul li a:visited{
	color: #fff;
	text-decoration: none;
}

#tabs_header div[id^=tabs_activate_], #tabs_header div#menu, #tabs_header div#account{
	color: #fff;
	font-size: 1.5em;
	display:inline-block;
	padding: 5px 0px;
	margin: 0px;
	margin-right: 0px;
	padding-left: 35px;
}
#tabs_header div#menu{
	margin-right: 0px;
	padding: 0px;
	padding-right: 40px;
}
#tabs_header div[id^=tabs_activate_]:hover,
#overlay_navigation ul li a:hover,
#overlay_navigation ul li a:active,
#overlay_account ul li a:hover,
#overlay_account ul li a:active,
#tabs_header div#menu:hover,
#tabs_header div#account:hover{
	filter: none; /* IE6-9 */
	-webkit-filter: none; /* Google Chrome, Safari 6+ & Opera 15+ */
	filter: none; /* Microsoft Edge and Firefox 35+ */
}
#tabs_header div:not(.tab_active),
#overlay_navigation ul li a,
#overlay_navigation ul li a:visited,
#overlay_account ul li a,
#overlay_account ul li a:visited,
#tabs_header div#menu,
#tabs_header div#account{
	filter: gray; /* IE6-9 */
	-webkit-filter: grayscale(1) opacity(30%); /* Google Chrome, Safari 6+ & Opera 15+ */
	filter: grayscale(1) opacity(30%); /* Microsoft Edge and Firefox 35+ */
}

#tabs_header div:hover,
#tabs_header div.tab_active,
#food_latest div:hover,
#food_sets_latest div:hover,
#food_ingredients div:hover,
#prediction div:hover, #food_set_prediction div:hover,
th, button, [id^=ingredient_]{
	cursor: pointer;
}

#food_latest div:hover,
#food_sets_latest div:hover,
#food_ingredients div:hover,
#prediction div:hover, #food_set_prediction div:hover{
	color: #23be63;
}

div[id^=tab_], div#loading, #db_update, #prediction div:nth-child(n+4), #food_set_prediction div:nth-child(n+4), .hidden{
	display: none;
}
div#tab_insert{
	display: block;
}
#food_latest div,
#food_sets_latest div,
#food_ingredients div{
	margin-bottom: 10px;
}
#prediction div, #food_set_prediction div{
	padding: 8px 0;
}

.oneliner{
	height: 20px;
	overflow: hidden;
	text-overflow: hidden;
}

.button_blue{
	background-color:#3369ff;
}
.button_red{
	background-color:#ee0033;
}
.button_green{
	background-color:#00cc00;
}
.button_yellow{
	background-color:#ff9933;
}

.night,
.night .text-input-wrapper,
.night select,
.night select option,
.night textarea,
.night input,
.night .feelbar_terrible{
	background: #333;
	color: #999;
}
.night{
	background: black;
}
.night #filter_table tr:nth-child(even){
	background: #666;
}
.night #filter_table tr:hover{
	color: #23be63;
}

.night .no_hover tr{
	background: inherit;
}
@media (prefers-color-scheme: dark) {
	/* nur win 10 bisher */
}

@media screen and (orientation:portrait){
	select{
		width: calc(50% - 6px);
	}

}
@media only screen and (min-width: 868px) {
	select{
		width: calc(50% - 6px);
	}
	.center{
		max-width: 768px;
		margin: 0px auto;
		border: 0px solid red;
	}
	table{
		max-width: 768px;
	}
	#tabs_header div[id^=tabs_activate_], #tabs_header div#menu, #tabs_header div#account{
		padding: 5px 0px;
		margin: 0px;
		margin-right: 35px;
		padding-left: 40px;
	}
	#tabs_header div#menu{
		margin: 0px;
		margin-right: 10px;
		padding-right: 40px;
	}
}
@media only screen and (max-width: 600px) {
	select{
		width: calc(50% - 6px);
	}
	.center{
		max-width: 100%;
	}
	table{
		max-width: 100%;
	}
	#tabs_header div.navigation{
		margin-right: 15px;
		text-indent: -99999px;
		white-space: nowrap;
		overflow: hidden;
	}
	#tabs_header div.navigation.tab_active{
		text-indent: 0px;
		white-space: nowrap;
		overflow: hidden;
	}
}

select, textarea, input, button{
	margin: 5px 0px;
	font-size: 1.5em;
	cursor: pointer;
	padding: 5px 10px;
	outline: 0;
	border: 0;
	border-radius: 5px;
	background: #e2e2e2;
	color: #333;
}
select#user_language{
	width: calc(100% - 6px - 36px);
	font-size: 1.0em;
	padding: 1px 10px;
	margin: 0px;
}
button{
	display:inline-block;
	
	border-radius: 8px;
	box-sizing: border-box;
	text-decoration:none;
	font-family:'Roboto',sans-serif;
	color:#FFFFFF;
	box-shadow:inset 0 -0.6em 1em -0.35em rgba(0,0,0,0.17),inset 0 0.6em 2em -0.3em rgba(255,255,255,0.15),inset 0 0 0em 0.05em rgba(128,128,128,0.12);
	text-align:center;
	position:relative;
}
footer{
	position: relative;
	font-size: 0.7em;
	color: #ccc;
	margin: 0 auto;
	padding: 10px 0;
	text-align: center;
	width: 100%;
	left: 0px;
	bottom: 0px;
}

/* input cancel */
input{
	width: calc(100% - 16px);
}
#form_search_input input, #foods, #ingredient{
	width: calc(100% - 25px);
}

input[id^="food_set_firma_"]{
	width: calc(25% - 25px);
}
input[id^="food_set_name_"]{
	width: calc(42% - 25px);
}
input[id^="food_set_ingredients_"]{
	width: calc(67% - 25px);
}
input[id^="db_update_"]{
	width: calc(20% - 8px);
}

button{
	margin-top: 5px;
	margin-left: 5px;
	width: calc(33% - 8px);
}

#form_search .text-input-wrapper, #form_login .text-input-wrapper, form .text-input-wrapper input {
	width: calc(100% - 28px);
}
#form_post .text-input-wrapper {
	width: calc(80% - 28px);
}
#form_post_ingredient .text-input-wrapper {
	width: calc(100% - 28px);
}
#form_login button{
	width: calc(100% - 8px);
	margin-left: 0px;
}
#form_login .text-input-wrapper input {
	width: calc(100% - 25px);
}

.text-input-wrapper {
	float: left;
	margin: 5px 0px;
	font-size: 1.5em;
	cursor: pointer;
	padding: 5px 10px;
	outline: 0;
	border: 0;
	border-radius: 5px;
	background: #e2e2e2;
	color: #333;
	display:inline-block;
}
.text-input-wrapper input {
	border: none;
	background: none;
	outline: none;
	padding: 0 0;
	margin: 0 0;
	font: inherit;
}
.text-input-wrapper span {
	cursor: pointer;
	color: red;
	font-weight: bold;
	visibility: hidden;
}

/* stacked bar chart */
.proz_bar{
	font-size: 0;
	border: 1px solid black;
	width: 0%;
}

.proz_bar div{
	display:inline-block;
	width: 100%;
	height: 20px;
	text-align: center;
	font: bold;
	color: white;
	font-size: 12px;
	/*background: linear-gradient(to right, green, green, green, yellow, yellow, yellow, orange, red);*/
}
div[class*='feel_'] {
	
}
.feelbar_good { background-color: green; }
.feelbar_ok { background-color: orange; }
.feelbar_bad { background-color: red; }
body:not(.night) .feelbar_terrible { background-color: black; color: white;}


.hover-content {
	display:none;
}
div[class*='feel_']:hover + .hover-content {
	display:block;
}