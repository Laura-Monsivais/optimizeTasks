import subprocess
import os
import webbrowser

def run_artisan_serve():
    project_path = r'C:\Users\laura\Documents\PROYECTOS\optimizeTasks'

    try:
        # Cambia al directorio del proyecto
        os.chdir(project_path)

        # Ejecuta el servidor Laravel
        subprocess.run(["php", "artisan", "serve"], shell=True)

    except KeyboardInterrupt:
        print("\nServidor detenido.")

if __name__ == "__main__":
    run_artisan_serve()
    # Abre el navegador después de iniciar el servidor
    webbrowser.get('chrome').open('http://127.0.0.1:8000')

