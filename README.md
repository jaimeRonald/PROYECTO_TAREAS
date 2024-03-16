 # creamos un usario prueba para acceder al login 
 # comandos para levantar el proyecto
 composer install
 php artisan key:generate
 php artisan migrate
 # un sider que cree para prueba 
 php artisan db:seed  
 



# servicio CERRAR SECION
  url : (http://127.0.0.1:8000/api/auth/logout1) metodo POST
  # servicio INICIAR SECION
  # SE TOMA EN CUENTA SE PUEDE MEJORAR EL FRONT USANODO LOS TOKEN GENERADOS EN ESTE SERIVICIO 
  url : (http://127.0.0.1:8000/api/auth/login1) metodo POST

 # servicio listar tareas 
  url : (http://127.0.0.1:8000/api/tasks) metodo GET

# servicio CREAR una tarea 
  url : (http://127.0.0.1:8000/api/tasks) metodo POST
# servicio ACTUALIZAR una tarea 
  url : (http://127.0.0.1:8000/api/tasks/{task}) metodo PUT

# se uso : 
# El middleware sanctum para proteger las rutas de los servicios 
#  Modificacion del archivo cors para qeu el front pueda enlazarse con el backend con el middleware Fruitcake 
# Para la autorizacion se uso Beaer (generacion de TOKEN)
#  Migraciones y herramientas postman para probar los servicios 



