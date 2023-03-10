import { selectIconToFile } from "../shop/fileProperties";

class Archivo {
    constructor( id, name, file, galeria, icon, registro ) {
        this.id         = id;
        this.name       = name;
        this.file       = file;
        this.galeria    = galeria;
        this.icon       = icon;
        this.id_archivo = registro;
        this.preview    = false;
        this.uploaded   = false;
    }
    
}

class Archivos {
    constructor( ) {
        this.files = [];
    }

    autoincrement() {
        return this.getLastFile() ? this.getLastFile().id+1: 0;
    }
    push( archivo ) {
        this.files.push(archivo);
    }
    getFile( i ) {
        return this.files[ i ];
    }
    getLastFile() {
        return this.files[this.files.length - 1];
    }
    filesNoPreviewByGaleria( galery){
        return this.files.filter( file => file.galeria == galery && !file.preview );
    }
    getfilesNoUpLoaded(){
        return this.files.filter( file => !file.uploaded );
    }
    setFilesFromArrayFile( files, galeria, registro = null ) {
        files.forEach(file => {
            this.push( new Archivo(
                this.autoincrement(),
                file.name,
                file,
                galeria,
                selectIconToFile(file.name),
                registro
            ));
        });
    }
    searchFileById( id_file ) {
        return this.files.find( file => file.id == id_file);
    }
    removeFileById( id_file ) {
        this.files = this.files.filter(file => file.id != id_file);
    }

}

export {
    Archivo,
    Archivos
};