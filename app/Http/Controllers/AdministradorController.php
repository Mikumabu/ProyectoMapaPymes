<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdministradorController extends Controller
{

    /* Método que envía correos electrónicos múltiples veces, donde $dato corresponde a los Formularios y $estado
    indica si dicho Formulario fue aceptado o rechazado. */

    public function enviarCorreo($datos, $estado){
        foreach($datos as $dato){
            if($estado == 'rechazado'){
                $to_name = 'JC';
                $to_email = $dato->mail;
                $data = array('name'=>"Lamentamos informar que su solicitud a #VitrineaEmprendedores ha sido rechazada",
                    "body" => "Estimado, junto con saludar, le informamos que su Empresa no cumple con los términos y
                               condiciones de USQAI para ingresar a #VitrineaEmprendedores. 
                               Saludos cordiales.");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Solicitud Rechazada');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador #VitrineaEmprendedores');
                });
                return;
            }
            if($estado == 'aceptado'){
                $to_name = 'JC';
                $to_email = $dato->mail;
                $data = array('name'=>"¡Felicitaciones! Su Solicitud de ingresar a #VitrineaEmprendedores ha sido aceptada",
                    "body" => "Estimado, 
                           le informamos que su solicitud ha sido aceptada, ahora podrá visualizar su Empresa
                           en http://usqai.cl/vitrineaemprendedores con todos los datos ingresados.
                           Saludos cordiales.");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Solicitud Aceptada');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador #VitrineaEmprendedores');
                });
            }
            if($estado == 'eliminar'){

                $to_name = 'JC';
                $to_email = $dato->mail;
                $data = array('name'=>"Lamentamos informar que ha sido eliminado de #VitrineaEmprendedores",
                    "body" => "Estimado, 
                           junto con saludar, le informamos que su Empresa ha sido eliminada ya que 
                           no cumple con los términos y
                           condiciones de USQAI para permanecer en #VitrineaEmprendedores. 
                           Saludos cordiales.");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Empresa Eliminada');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador #VitrineaEmprendedores');
                });

            }
        }
    }

    /* Método que envía todos los datos de los Formularios Pendientes a la Vista del Administrador */

    public function mostrarDatos(Request $request){

        $formularios = DB::table('formularios')->get();

        return view('Administrador/Administrador',compact('formularios', 'request'));

    }

    /* Método que elimina (o rechaza) un Formulario Pendiente, el cual es borrado de la tabla "formularios"
       y agregado en la tabla "historial_rechazados". También envía los datos al método "enviarCorreo". */

    public function rechazar($id){

        $formularios = DB::select('select mail from formularios where id = :id', ['id' => $id]);
        $this->enviarCorreo($formularios, 'rechazado');

        $formulario = DB::table('formularios')->where('id', '=', $id)->first();

        $nombreEmpresa = $formulario->nombre_empresa;
        $rutEmpresa = $formulario->rut_empresa;
        $queOfrece = $formulario->categoria;
        $calle = $formulario->ubicacion;
        $horario = $formulario->horario;
        $facebook = $formulario->facebook;
        $instagram = $formulario->instagram;
        $url = $formulario->url;
        $formalizado = $formulario->formalizado;
        $comuna = $formulario->comuna;
        $contacto = $formulario->contacto;
        $telefono = $formulario->telefono;
        $email = $formulario->mail;
        $descripcion = $formulario->descripcion;
        $icono = $formulario->icono;
        $latitud = $formulario->latitud;
        $longitud = $formulario->longitud;
        $rutaImagen = $formulario->imagen;

        DB::table('historial_rechazados')->insert([
            'nombre_empresa' => $nombreEmpresa,
            'rut_empresa' => $rutEmpresa,
            'categoria' => $queOfrece,
            'longitud' => $longitud,
            'latitud' => $latitud,
            'ubicacion' => $calle,
            'horario' => $horario,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'url' => $url,
            'formalizado' => $formalizado,
            'comuna' => $comuna,
            'contacto' => $contacto,
            'telefono' => $telefono,
            'mail' => $email,
            'descripcion' => $descripcion,
            'icono' => $icono,
            'imagen' => $rutaImagen
        ]);


        DB::table('formularios')->where('id', '=', $id)->delete();
        return back()->with('exito2','Formulario rechazado correctamente');
    }

    /* Método que rechaza múltiples Formularios, los elimina de la tabla "formularios" y se procede a insertar dichos
       Formularios en "historial_rechazados". Luego se envían los datos al método "enviarCorreo" */

    public function rechazarMasa(Request $request){
        $idArray = $request->input('id');
        $emprendedor = DB::table("formularios")->whereIn('id', $idArray)->get();
        $this->enviarCorreo($emprendedor, 'rechazado');

        $formularios = DB::table('formularios')->whereIn('id', $idArray)->get();
        foreach($formularios as $formulario){
            $nombreEmpresa = $formulario->nombre_empresa;
            $rutEmpresa = $formulario->rut_empresa;
            $queOfrece = $formulario->categoria;
            $calle = $formulario->ubicacion;
            $horario = $formulario->horario;
            $facebook = $formulario->facebook;
            $instagram = $formulario->instagram;
            $url = $formulario->url;
            $formalizado = $formulario->formalizado;
            $comuna = $formulario->comuna;
            $contacto = $formulario->contacto;
            $telefono = $formulario->telefono;
            $email = $formulario->mail;
            $descripcion = $formulario->descripcion;
            $icono = $formulario->icono;
            $latitud = $formulario->latitud;
            $longitud = $formulario->longitud;
            $rutaImagen = $formulario->imagen;

            DB::table('historial_rechazados')->insert([
                'nombre_empresa' => $nombreEmpresa,
                'rut_empresa' => $rutEmpresa,
                'categoria' => $queOfrece,
                'longitud' => $longitud,
                'latitud' => $latitud,
                'ubicacion' => $calle,
                'horario' => $horario,
                'facebook' => $facebook,
                'instagram' => $instagram,
                'url' => $url,
                'formalizado' => $formalizado,
                'comuna' => $comuna,
                'contacto' => $contacto,
                'telefono' => $telefono,
                'mail' => $email,
                'descripcion' => $descripcion,
                'icono' => $icono,
                'imagen' => $rutaImagen
            ]);
        }
        DB::table("formularios")->whereIn('id', $idArray)->delete();
    }

    /* Método que se utiliza cuando el Administrador acepta un Formulario. Dicho Formulario se inserta en la tabla
       "formularios_aprobados" y se procede a eliminar de la tabla "formulario" que corresponde a los pendientes */

    public function aceptar($id){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook,
        instagram, url, formalizado, comuna, contacto, telefono, mail, descripcion, icono, latitud, longitud, imagen
        from formularios where id = :id', ['id' => $id]);
        $this->enviarCorreo($formularios, 'aceptado');
        foreach($formularios as $formulario){
            $nombreEmpresa = $formulario->nombre_empresa;
            $rutEmpresa = $formulario->rut_empresa;
            $queOfrece = $formulario->categoria;
            $calle = $formulario->ubicacion;
            $horario = $formulario->horario;
            $facebook = $formulario->facebook;
            $instagram = $formulario->instagram;
            $url = $formulario->url;
            $formalizado = $formulario->formalizado;
            $comuna = $formulario->comuna;
            $contacto = $formulario->contacto;
            $telefono = $formulario->telefono;
            $email = $formulario->mail;
            $descripcion = $formulario->descripcion;
            $icono = $formulario->icono;
            $latitud = $formulario->latitud;
            $longitud = $formulario->longitud;
            $rutaImagen = $formulario->imagen;

            DB::table('formularios_aprobados')->insert([
                'nombre_empresa' => $nombreEmpresa,
                'rut_empresa' => $rutEmpresa,
                'categoria' => $queOfrece,
                'longitud' => $longitud,
                'latitud' => $latitud,
                'ubicacion' => $calle,
                'horario' => $horario,
                'facebook' => $facebook,
                'instagram' => $instagram,
                'url' => $url,
                'formalizado' => $formalizado,
                'comuna' => $comuna,
                'contacto' => $contacto,
                'telefono' => $telefono,
                'mail' => $email,
                'descripcion' => $descripcion,
                'icono' => $icono,
                'imagen' => $rutaImagen
            ]);
        }

        DB::table('formularios')->where('id', '=', $id)->delete();

        return redirect()->route('Administrador')->with('exito3','Formulario ingresado correctamente');

    }

    /* Método que acepta múltiples Formularios. Dichos Formularios se insertan en la tabla
       "formularios_aprobados" y se procede a eliminar de la tabla "formulario" que corresponde a los pendientes */

    public function aceptarMasa(Request $request){
        $idArray = $request->input('id');
        $emprendedor = DB::table("formularios")->whereIn('id', $idArray)->get();
        $this->enviarCorreo($emprendedor, 'aceptado');

        $formularios = DB::table('formularios')->whereIn('id', $idArray)->get();
        foreach($formularios as $formulario){
            $nombreEmpresa = $formulario->nombre_empresa;
            $rutEmpresa = $formulario->rut_empresa;
            $queOfrece = $formulario->categoria;
            $calle = $formulario->ubicacion;
            $horario = $formulario->horario;
            $facebook = $formulario->facebook;
            $instagram = $formulario->instagram;
            $url = $formulario->url;
            $formalizado = $formulario->formalizado;
            $comuna = $formulario->comuna;
            $contacto = $formulario->contacto;
            $telefono = $formulario->telefono;
            $email = $formulario->mail;
            $descripcion = $formulario->descripcion;
            $icono = $formulario->icono;
            $latitud = $formulario->latitud;
            $longitud = $formulario->longitud;
            $rutaImagen = $formulario->imagen;

            DB::table('formularios_aprobados')->insert([
                'nombre_empresa' => $nombreEmpresa,
                'rut_empresa' => $rutEmpresa,
                'categoria' => $queOfrece,
                'longitud' => $longitud,
                'latitud' => $latitud,
                'ubicacion' => $calle,
                'horario' => $horario,
                'facebook' => $facebook,
                'instagram' => $instagram,
                'url' => $url,
                'formalizado' => $formalizado,
                'comuna' => $comuna,
                'contacto' => $contacto,
                'telefono' => $telefono,
                'mail' => $email,
                'descripcion' => $descripcion,
                'icono' => $icono,
                'imagen' => $rutaImagen
            ]);
        }
        DB::table("formularios")->whereIn('id', $idArray)->delete();
    }

    /* Método que envía los datos de todos los Formularios Aprobados a la Vista del Administrador */

    public function aprobados(){

        $formularios_aprobados = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook, instagram, url, formalizado, comuna, contacto, telefono, mail, descripcion  from formularios_aprobados');
        return view('Administrador/AdministradorAprobados',compact('formularios_aprobados', 'request'));
    }

    /* Método que elimina un Formulario Aprobado utilizando su ID enviada por el Administrador */

    public function eliminar($id){

        $formularios = DB::select('select mail from formularios_aprobados where id = :id', ['id' => $id]);
        $this->enviarCorreo($formularios, 'eliminar');

        DB::table('formularios_aprobados')->where('id', '=', $id)->delete();



        return back()->with('exito2','Formulario eliminado correctamente');
    }

    /* Método que envía los datos de todas las Palabras Prohibidas a la Vista del Administrador */

    public function palabrasProhibidas(){

        $palabras_prohibidas = DB::select('select insulto from palabras_prohibidas');
        return view('Administrador/AdministradorInsultos',compact('palabras_prohibidas', 'request'));
    }

    /* Método que recibe una Palabra Prohibida para luego ser insertada en la tabla "palabras_prohibidas" */

    public function ingresarInsulto(Request $request){

        $insulto = request()->insulto;

        if($insulto == null){
            return back();
        }else{

            DB::table('palabras_prohibidas')->insert([
                'insulto' => $insulto
            ]);

            return back()->with('exito1','Insulto agregado correctamente');

        }

    }

    /* Método que envía el historial de los Formularios Rechazados a la Vista del Administrador */

    public function historialRechazados(){

        $historial_rechazados = DB::table('historial_rechazados')->get();

        return view('Administrador/AdministradorHistorial',compact('historial_rechazados', 'request'));
    }

    /* Método que recibe la ID de un Formulario que se encuentra en "historial_rechazados" para recuperarlo. En base a
       dicha ID se recuperan sus datos y se vuelven a insertar en la tabla "formularios" */

    public function recuperarRechazado($id){

        $formularios = DB::select('select id, nombre_empresa, rut_empresa, categoria, ubicacion, horario, facebook,
        instagram, url, formalizado, comuna, contacto, telefono, mail, descripcion, icono, latitud, longitud, imagen
        from historial_rechazados where id = :id', ['id' => $id]);

        foreach($formularios as $formulario){
            $nombreEmpresa = $formulario->nombre_empresa;
            $rutEmpresa = $formulario->rut_empresa;
            $queOfrece = $formulario->categoria;
            $calle = $formulario->ubicacion;
            $horario = $formulario->horario;
            $facebook = $formulario->facebook;
            $instagram = $formulario->instagram;
            $url = $formulario->url;
            $formalizado = $formulario->formalizado;
            $comuna = $formulario->comuna;
            $contacto = $formulario->contacto;
            $telefono = $formulario->telefono;
            $email = $formulario->mail;
            $descripcion = $formulario->descripcion;
            $icono = $formulario->icono;
            $latitud = $formulario->latitud;
            $longitud = $formulario->longitud;
            $rutaImagen = $formulario->imagen;

            DB::table('formularios')->insert([
                'nombre_empresa' => $nombreEmpresa,
                'rut_empresa' => $rutEmpresa,
                'categoria' => $queOfrece,
                'longitud' => $longitud,
                'latitud' => $latitud,
                'ubicacion' => $calle,
                'horario' => $horario,
                'facebook' => $facebook,
                'instagram' => $instagram,
                'url' => $url,
                'formalizado' => $formalizado,
                'comuna' => $comuna,
                'contacto' => $contacto,
                'telefono' => $telefono,
                'mail' => $email,
                'descripcion' => $descripcion,
                'icono' => $icono,
                'imagen' => $rutaImagen
            ]);


        }

        DB::table('historial_rechazados')->where('id', '=', $id)->delete();

        return back()->with('exito2','Formulario recuperado correctamente');

    }

    /* Método que elimina todos los datos de la tabla "historial_rechazados" */

    public function borrarHistorial(){

        DB::table('historial_rechazados')->delete();

        return back()->with('exito1','Historial eliminado');

    }

    /* Método que redirecciona a la Vista de agregar nuevos Administradores */

    public function ingresarDatosAdministrador(){

        return view('Administrador/AgregarAdministrador');
    }

    /* Método que recibe los datos del nuevo Administrador para ser insertado en la tabla "users" que contiene a
       los Administradores. Se comprueba que los parámetros estén correctos */

    public function agregarAdministrador(Request $request){

        if($request->nombre != null && $request->correo != null && $request->correo != null && $request->contraseñaConfirmar != null){

            if($request->contraseña == $request->contraseñaConfirmar){

                $contraseña = \Hash::make($request->contraseña);

                DB::table('users')->insert([
                    'name' => $request->nombre,
                    'email' => $request->correo,
                    'password' => $contraseña
                ]);

                $to_name = 'JC';
                $to_email = $request->correo;
                $data = array('name'=>"¡Felicitaciones! Ha sido ingresado como Administrador",
                    "body" => "Estimado, 
                           le informamos que ha sido registrado como Administrador de #VitrineaEmprendedores, ahora tendrá
                           acceso a toda la configuración del Sitio Web.");

                \Mail::send('Email\send_email', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Administrador Registrado');
                    $message->from('jmr025@alumnos.ucn.cl','Administrador #VitrineaEmprendedores');
                });

                return back()->with('exito1','Administrador ingresado correctamente');

            }

            return back()->with('error2','ERROR: Las Contraseñas deben ser iguales');

        }

        return back()->with('error1','ERROR: Debe completar todos los campos');

    }
}

