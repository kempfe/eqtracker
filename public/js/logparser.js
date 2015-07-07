$(function(){
    $('#parseForm').submit(function(e){
        parseLog(document.getElementById('logfile').files[0]);
       return false; 
    });
});

function parseLog(file){
    var reader = new FileReader();
    reader.onload = function(progressEvent){
    var lines = this.result.split('\n');
    $('.progress-bar').width("0%");
    var progress = 0;
    for(var line = 0; line < lines.length; line++){
      var matches1 = lines[line].match(/\[(.*)\] <SYSTEMWIDE_MESSAGE>: (.*) has/);
      var matches2 = lines[line].match(/\[(.*)\].*<<KILL-LOG>> (.*)/);
      if(matches1 || matches2){
          if(matches1){
              var matches = matches1;
          }
          else{
              var matches = matches2;
          }
          console.log(matches);
          $.ajax("/parser/addkill",{
                data : {npc : matches[2],killtime : matches[1]},
                method  : 'POST',
                success : function(result){
                    var item = $("<li class='list-group-item' />");
                    switch(result.statusCode){
                        case 0 :
                            item.addClass('text-success');
                            item.html(result.statusMessage);
                            break;
                        case 1 :
                            item.addClass('text-warning');
                            item.html(result.statusMessage);
                            break;
                        case 2 :
                            item.addClass('text-danger');
                            item.html(result.statusMessage);
                            break;
                    }
                    $('.notifications').append(item);
                }
          });
          
      }
     
    }
  };
    reader.readAsText(file);
}