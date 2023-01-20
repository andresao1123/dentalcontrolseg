
$(document).ready(function(){
    
    $('#abonoPaciente').on('input',function(){
        if($(this).val()==''){
            $('#SaldoRestante').val(parseFloat($('#Saldo').val())-0);
            return;
        }
        $('#SaldoRestante').val(parseFloat($('#Saldo').val())-parseFloat($('#abonoPaciente').val()));
        return;
    });
   
    $('#SaldoRestante').val(parseFloat($('#Saldo').val())-0);
    $('#decimales').on('input', function () {
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
      });
      $('#abonoPacientes').on('input', function () {
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
      });

    $(".CirPrevia").click(function(evento){
          
        var valor = $(this).val();
      
        if(valor == 'Si'){
            $("#CirujiasPrevias").css("display", "block");
        }else{
            $("#CirujiasPrevias").css("display", "none");
        }
    });

    $('#ComboConBusqueda').select2();
    
    if($('input[name="Cirujia"]:checked').val()=="No"){
        $("#CirujiasPrevias").css("display", "none");
    }
    
    $('#ComboDoctoresClinica').select2();
    $('#ComboProductos').select2();
    
    $('#ComboProductos').change(function(){
        var base_url = window.location.origin;
        $.ajax({
            type:'get',
            url: base_url+"/Inventarios/getSingleProduct",
            dataType: 'json',
            data:{id:$(this).val()},
            complete:function(){},
            success: function(data){
                $('#Tipo').val(data.inventario[0].Tipo);
                $('#CantidadActual').val(data.inventario[0].CantidadActual);
                $('#CantidadMaxima').val(data.inventario[0].CantidadMaxima);
                $('#CantidadMinima').val(data.inventario[0].CantidadMinima);
                
            },
            error: function(){
                alert("Esto es un error");
            }
        })
    });
    $('.DeleteProducto').click(function(){
        if (window.confirm("¿Estás seguro que quieres eliminar el producto?")) {
            var base_url = window.location.origin;
            $.ajax({
                type:'get',
                url: base_url+"/Inventarios/borrarProducto",
                dataType: 'json',
                data:{id:$(this).closest('tr').find('td:eq(0)').text()},
                complete:function(){},
                success: function(data){
                    alert("Producto borrado con exito");
                    window.location.href=data.url;
                },
                error: function(){
                    alert("Esto es un error");
                }
            })
        }
        else{
            return;
        }
    });

    $('.DeletePaciente').click(function(){
        if (window.confirm("¿Estás seguro que quieres eliminar el paciente?")) {
            var base_url = window.location.origin;
            $.ajax({
                type:'get',
                url: base_url+"/Pacientes/Borrar",
                dataType: 'json',
                data:{id:$(this).closest('tr').find('td:eq(0)').text()},
                complete:function(){},
                success: function(data){
                    alert("Paciente borrado con exito");
                    window.location.href=data.url;
                },
                error: function(){
                    alert("Esto es un error");
                }
            })
        }
        else{
            return;
        }
    });

    $('.DeleteTratamiento').click(function(){
        if (window.confirm("¿Estás seguro que quieres eliminar el tratamiento?")) {
            var base_url = window.location.origin;
            $.ajax({
                type:'get',
                url: base_url+"/Tratamientos/borrarTratamiento",
                dataType: 'json',
                data:{id:$(this).closest('tr').find('td:eq(0)').text(),IdPaciente:$("#idPaciente").val()},
                complete:function(){},
                success: function(data){
                    alert("Tratamiento borrado con exito");
                    window.location.href=data.url;
                },
                error: function(){
                    alert("Esto es un error");
                }
            })
        }
        else{
            return;
        }
    });
    $('.DeleteDoctor').click(function(){
        if (window.confirm("¿Estás seguro que quieres eliminar el doctor?")) {
            var base_url = window.location.origin;
            $.ajax({
                type:'get',
                url: base_url+"/Doctores/borrarDoctor",
                dataType: 'json',
                data:{id:$(this).closest('tr').find('td:eq(0)').text()},
                complete:function(){},
                success: function(data){
                    alert("Doctor borrado con exito");
                    window.location.href=data.url;
                },
                error: function(){
                    alert("Esto es un error");
                }
            })
        }
        else{
            return;
        }
    });

    var btnAbrirPopup = document.getElementById('butonAyuda'),
    overlay=document.getElementById('overlay'),
    popup =document.getElementById('popup'),
    btnCerrarPopup = document.getElementById('btn-cerrar-popup');

    if(btnAbrirPopup!=null){
        btnAbrirPopup.addEventListener('click',function(){
            overlay.classList.add('active');
            popup.classList.add('active');
        });
    }
    if(btnCerrarPopup!= null){
        btnCerrarPopup.addEventListener('click',function(){
            overlay.classList.remove('active');
            popup.classList.remove('active');
        });
    }

    $('#ComboCitasClinica').select2();
    $('#ComboCitasClinica').change(function(){
        $('#CitasEstado').jqGrid().setGridParam({url : window.location.origin+"/Citas/obtenerTodasLasCitas?estado="+$(this).val()}).trigger("reloadGrid");
    });
    
    $('#CitasEstado').jqGrid({
        url: window.location.origin+"/Citas/obtenerTodasLasCitas?estado="+$('#ComboCitasClinica').val(),
        dataType:'json',
        mtype:'GET',
        width:1300,
        colNames:['id_cita','Nombre del paciente','Nombre del doctor','Fecha de la cita','Hora de la cita','Estado'],
        colModel:[
            {name: 'id_cita',index:'id_cita', key:true, hidden:true, widht:50},
            {name: 'Nombre del paciente',index:'Nombre del paciente',width:50},
            {name: 'Nombre del doctor',index:'Nombre del doctor',width:50},
            {name: 'Fecha de la cita',index:'Fecha de la cita',width:50},
            {name: 'Hora de la cita',index:'Hora de la cita',width:50},
            {name: 'Estado',index:'Estado',width:50}
        ],
        sortname: 'Estado',
        editable: false,
        sortorder: "asc",
        pager: '#pager2'
    });
    $("#CitasEstado").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});

    /*Calendarios*/
   
    $(".closeModal").click(function(){
        $('#cita').modal("hide");
    })
    $('.closeModalVer').click(function(){
        $('#citaVer').modal("hide");
    })

    var id = $('#Rol').val();
    if(id =="Doctor"){
        var calendarEl = document.getElementById('agenda');
        $calendar = new FullCalendar.Calendar(calendarEl,{
            timeZone: 'local',
            initialView: 'timeGridWeek',
            locale: "es",
            headerToolbar:{
                left:'prev,next today',
                center: 'title',
                right: 'dayGridMonth, timeGridWeek,listWeek'
            },
                events: window.location.origin+"/Eventos/show",
                eventClick: function(info){
                    var eventoId = info.event.id;
                    $.ajax({
                        type:'post',
                        url: window.location.origin+"/Eventos/find",
                        dataType: 'json',
                        data: {
                            id: eventoId
                        },
                        success:function(data){
                            var obj = JSON.parse(JSON.stringify(data));
                            var fechaInicio = new Date(obj.citas.start);
                            var fechaFin = new Date(obj.citas.end);
                            var doctor = obj.citas.descripcion;
                            var paciente = obj.citas.title;
                            var fechaEntera = fechaInicio.getFullYear()+'-'+( fechaInicio.getMonth()+1)+'-'+ fechaInicio.getDate();
                            var horaInicio = fechaInicio.getHours()+":"+String(fechaInicio.getMinutes()).padStart(2,'0');
                            var horaFin =fechaFin.getHours()+":"+String(fechaFin.getMinutes()).padStart(2,'0');
                            $('#DoctorCita').val(doctor);
                            $('#PacienteCita').val(paciente);
                            $('#FechaCita').val( fechaEntera);
                            $('#horaInicioCita').val(horaInicio);
                            $('#horaFinCita').val(horaFin);
                            $('#citaVer').modal('show');
                        }
                    })
                }
                
        });
        $calendar.render();
    }
    else{
            var calendarEl = document.getElementById('agenda');
            $calendar = new FullCalendar.Calendar(calendarEl,{
            timeZone: 'local',
            initialView: 'timeGridWeek',
            locale: "es",
            headerToolbar:{
                left:'prev,next today',
                center: 'title',
                right: 'dayGridMonth, timeGridWeek,listWeek'
            },
                events: window.location.origin+"/Eventos/show",
                eventClick: function(info){
                    var eventoId = info.event.id;
                    $.ajax({
                        type:'post',
                        url: window.location.origin+"/Eventos/find",
                        dataType: 'json',
                        data: {
                            id: eventoId
                        },
                        success:function(data){
                            var obj = JSON.parse(JSON.stringify(data));
                            var fechaInicio = new Date(obj.citas.start);
                            var fechaFin = new Date(obj.citas.end);
                            var doctor = obj.citas.descripcion;
                            var paciente = obj.citas.title;
                            var fechaEntera = fechaInicio.getFullYear()+'-'+( fechaInicio.getMonth()+1)+'-'+ fechaInicio.getDate();
                            var horaInicio = fechaInicio.getHours()+":"+String(fechaInicio.getMinutes()).padStart(2,'0');
                            var horaFin =fechaFin.getHours()+":"+String(fechaFin.getMinutes()).padStart(2,'0');
                            $('#DoctorCita').val(doctor);
                            $('#PacienteCita').val(paciente);
                            $('#FechaCita').val( fechaEntera);
                            $('#horaInicioCita').val(horaInicio);
                            $('#horaFinCita').val(horaFin);
                            $('#citaVer').modal('show');
                        }
                    })
                },
                dateClick:function(info){
                    var mnth =("0" + (info.date.getMonth() + 1)).slice(-2);
                    var day = ("0" + info.date.getDate()).slice(-2);
                    var str= [info.date.getFullYear(), mnth, day].join("-");
                    var actual = new Date();
                    var hora= info.date.getHours() + ":" + String(info.date.getMinutes()).padStart(2,'0');
                    if(info.date.getFullYear() >= actual.getFullYear()){
                        if(info.date.getFullYear() > actual.getFullYear()){
                            $('#FechaCita').val(str);
                            $('#horaCitaCrear').val(hora);
                            $('#ComboDoctores').select2({
                                dropdownParent: $('#cita')
                            });
                            $('#ComboPacientes').select2({
                                dropdownParent: $('#cita')
                            });
                            $('#cita').modal("show");
                        }
                        else if(info.date.getFullYear() == actual.getFullYear()){
                            if(info.date.getMonth() >= actual.getMonth()){
                                if(info.date.getMonth() > actual.getMonth()){
                                    $('#FechaCita').val(str);
                                    $('#horaCitaCrear').val(hora);
                                    $('#ComboDoctores').select2({
                                        dropdownParent: $('#cita')
                                    });
                                    $('#ComboPacientes').select2({
                                        dropdownParent: $('#cita')
                                    });
                                    $('#cita').modal("show");
                                }
                                else if(info.date.getMonth() == actual.getMonth()){
                                    if(info.date.getDate() >= actual.getDate()){
                                        $('#FechaCita').val(str);
                                        $('#horaCitaCrear').val(hora)
                                        $('#ComboDoctores').select2({
                                            dropdownParent: $('#cita')
                                        });
                                        $('#ComboPacientes').select2({
                                            dropdownParent: $('#cita')
                                        });
                                        $('#cita').modal("show");
                                    }
                                    else{
                                        alert("Error: No se puede solicitar una cita en una fecha vencida");
                                    }
                                }
                                else{
                                    alert("Error: No se puede solicitar una cita en una fecha vencida");
                                }
                            }
                            else{
                                alert("Error: No se puede solicitar una cita en una fecha vencida");
                            }
                        }
                        else{
                            alert("Error: No se puede solicitar una cita en una fecha vencida"); 
                        }
                        
                        
                    }else{
                    alert("Error: No se puede solicitar una cita en una fecha vencida");
                    }
                
                }
            });
            $calendar.render();
            
    }
    
    $('#ComboDoctoresClinica').change(function(){
        var idDoctor = $(this).val()
        if(idDoctor != "-1"){
            $.ajax({
                type:'post',
                url: window.location.origin+"/Eventos/show",
                dataType: 'json',
                data: {
                    id: idDoctor
                },
                complete:function(){},
                success:function(data){
                    $calendar.removeAllEvents();
                    if(data.citas != null){
                        if(data.citas != null)
                        $calendar.addEventSource( data.citas );
                        //$calendar.refetchEvents();
                    }
                    
                },
                error:function(){

                }
            });
        }
        else{
            $.ajax({
                type:'post',
                url: window.location.origin+"/Eventos/show",
                dataType: 'json',
                data: {
                    id: null
                },
                complete:function(){},
                success:function(data){
                    $calendar.removeAllEvents();
                    if(data.citas != null){
                        $calendar.addEventSource( data.citas );
                        $calendar.refetchEvents();
                    }
                    
                },
                error:function(){

                }
            });
        }
    }).change();

    $('.agregarCita').click(function(){
        console.log("Eje");
        var base_url = window.location.origin;
        var idDoctor = $('#ComboDoctores').val();
        var fecha = $('#FechaCita').val();
        var hora= $('#horaCitaCrear').val();
        var idPaciente=$('#ComboPacientes').val()
        $.ajax({
            type:'post',
            url: base_url + "/Citas/agendarCita",
            dataType: 'json',
            data:
            {
                idDoctor:idDoctor,
                fecha: fecha,
                hora: hora,
                idPaciente: idPaciente
            },
            complete:function(){},
            success: function(data){
                if(data.available){
                    alert("Cita agregada con exito");
                    window.location.href=data.url;
                }
                else{
                    alert("Este horario no está disponible");
                }
            },
            error: function(){
                alert("Esto es un error");
            }
        })
    });
    /*fin area calendarios*/

   
});