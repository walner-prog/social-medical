<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
     
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
   
        
    </head>
    <body>
        
    <div class=" py-24">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
            <div class="flex flex-wrap -mx-3 mb-5">
               
                    <div class="relative flex-[1_auto] flex flex-col break-words min-w-0  bg-white m-5 max-w-7xl mx-auto sm:px-6 lg:px-8  dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                        <div class="relative flex flex-col min-w-0 break-words border-stone-200 bg-light/30 ">
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                                <a href="{{ route('citas.program') }}" class=" mb-4 inline-block px-6 py-2 text-white bg-blue-800 hover:bg-blue-950 rounded-lg shadow-lg">
                                    regresar Citas Programadas
                                </a>
                                    <select id="doctorSelect" name="doctor_id" class="dark:bg-gray-900 text-gray-800 dark:text-gray-100">
                                        <option class="dark:text-gray-800 dark:bg-gray-900" value="">Seleccione un doctor</option>
                                        <!-- Aquí puedes cargar dinámicamente los doctores -->
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                        @endforeach
                                    </select>
                                    
                            </div>

                            <div id="calendar" class=" p-4"></div>
        
                            <div class="flex-auto block py-8 pt-6 px-9 ">
                                 
                                   <livewire:appointment-manager />
                        </div>

                        
                    </div>

                   
                    


                   
                    

               
            </div>
        </div>
  
    </div>


  




    <script type="text/javascript">
        $(document).ready(function () {
               var SITEURL = "{{ url('/') }}";
       
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               var calendar = $('#calendar').fullCalendar({
             locale: 'es',
             timeZone: 'America/Managua',
             editable: true,
             businessHours: {
           daysOfWeek: [1, 2, 3, 4, 5,6,7], // Lunes a viernes
           startTime: '08:00', // Inicio del horario (08:00 AM)
           endTime: '17:00', // Fin del horario (05:00 PM)
       },
       weekends: true, //False  Oculta sábados y domingos como no disponibles
       
      // selectConstraint: "businessHours", // Limitar selección al horario comercial
      
       selectable: true, // Permitir selección en el calendario
              events: function(start, end, timezone, callback) {
               // Obtener el doctor seleccionado
               var doctor_id = $('#doctorSelect').val();
   
               // Hacer la llamada AJAX con el doctor seleccionado
               $.ajax({
                   url: SITEURL + "/appointmentCalendar", 
                   data: {
                       start: start.format(),
                       end: end.format(),
                       doctor_id: doctor_id,  // Pasar el doctor_id seleccionado
                   },
                   success: function(data) {
                       var events = data.map(function(appointment) {
                           return {
                               id: appointment.id,
                               title: appointment.title,
                               start: appointment.start,
                               end: appointment.end,
                               doctor_id: appointment.doctor_id,
                           };
                       });
                       callback(events); // Cargar las citas del doctor en el calendario
                   }
               });
           },
           displayEventTime: true,
           eventRender: function (event, element) {
               // Formato de la fecha
               var formattedStart = moment(event.start).format('DD-MM-YY hh:mm A');
               var formattedEnd = moment(event.end).format('DD-MM-YY hh:mm A');
   
               element.find('.fc-title').html(`
                   <b>${event.title}</b><br>
                   Ini: ${formattedStart}<br>
                   Fin: ${formattedEnd}
               `);
           },
           selectable: true,
           selectHelper: true,
           select: function(start, end) {
               openModal({ start, end }); // Crear cita
           },
           eventClick: function(event) {
               openModal(event); // Editar o eliminar cita
           }
       });
   
       
               // Función para abrir el modal
               function openModal(event) {
                   $('#modalForm #title').val(event.title || '');
                   $('#modalForm #doctor_id').val(event.doctor_id || '');
                   $('#modalForm #start').val(event.start || '');
                   $('#modalForm #end').val(event.end || '');
                   $('#modalForm').modal('show');
               }
       
               // Cuando el paciente selecciona un doctor
               $('#doctorSelect').change(function() {
                   // Refrescar los eventos en el calendario con el nuevo doctor seleccionado
                   $('#calendar').fullCalendar('refetchEvents');
               });
       
               $('#saveBtn').click(function () {
                   var data = {
                       title: $('#modalForm #title').val(),
                       start: $('#modalForm #start').val(),
                       end: $('#modalForm #end').val(),
                       doctor_id: $('#modalForm #doctor_id').val(),
                       patient_id: '{{ auth()->id() }}',
                       type: 'add'
                   };
       
                   $.post(SITEURL + "/fullcalenderAjax2", data, function (response) {
                       $('#calendar').fullCalendar('refetchEvents');
                       $('#modalForm').modal('hide');
                       toastr.success('Cita creada correctamente.');
                   }).fail(function (xhr) {
                       toastr.error(xhr.responseJSON.error);
                   });
               });
           });
       </script>
   
       
   
       
   
    </body>
    </html>
  
   



</x-app-layout>

