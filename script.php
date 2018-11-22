 <script>  
 <?php $tipoConteudo = new ConteudoDAO($conexao); ?>
 $(document).ready(function(){  
    var i=1;
    var pre=1;
    var pos=1;
      $('#adicionar').click(function(){
        if ( i < 5) {
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'"><td><center><input type="text" name="qntdAlternativas[]" placeholder="Alternativa '+i+'" class="form-control name_list" /></center></td><td><center><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</center></button><td><center><input type="radio" name="correta_id" value='+i+'></center></td></td></tr>');
        } else {
            alert("Número máximo de alternativas atingido.");
        }
           
      });  

      $('#maisConteudo').click(function(){
        i++;  			
        //$('#dynamic_field').append('<tr id="row'+i+'"><td><center><h3>Conteúdo '+i+'</h3></center></td></td><td><input type="text" name="nomeConteudo[]" placeholder="Informar conteúdo" class="form-control" /></center></td> <td><center><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"> x </button></center></td> ');
        $('#dynamic_field').append('<tr id="row'+i+'"> </td><td><input type="text" name="nomeConteudo[]" placeholder="Informar conteúdo" class="form-control"/></center></td> <td> <input type="number" name="maxAcerto[]" placeholder="Informar quantidade máxima de acertos"  class="form-control" /> <td> <input type="number" name="maxErro[]" placeholder="Informar quantidade máxima de erros"  class="form-control" /> </td> </td><td><center> <button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"> x </button></center></td> ');
      }); 

    $('#maisPreRequisito').click(function(){
        pre++;  			
        $('#dynamic_field').append('<tr id="row'+pre+'"><td><center><h3>Pré-requisito '+pre+'</h3></center></td></td><td colspan="2"><select name="preRequisito[]" class="form-control"><?php foreach($tipoConteudo->listaNomeConteudo() as $preRequisito) : ?><option value="<?=$preRequisito['id']?>"><?=$preRequisito['nomeConteudo']; ?> </option><?php endforeach ?><td><center><button type="button" name="remove" id="'+pre+'" class="btn btn-danger btn_remove"> x </button></center></td> ');
    }); 

        $('#maisPosRequisito').click(function(){
        pos++;  			
        $('#dynamic_field').append('<tr id="row'+pos+'"><td><center><h3>Pós-requisito '+pos+'</h3></center></td></td><td colspan="2"><select name="posRequisito[]" class="form-control"><?php foreach($tipoConteudo->listaNomeConteudo() as $posRequisito) : ?><option value="<?=$posRequisito['id']?>"><?=$posRequisito['nomeConteudo']; ?> </option><?php endforeach ?><td><center><button type="button" name="remove" id="'+pos+'" class="btn btn-danger btn_remove"> x </button></center></td> ');
    }); 

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           i--;
           
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>