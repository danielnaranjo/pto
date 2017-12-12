//== Class definition

var DropzoneDemo = function () {
    //== Private functions
    var demos = function () {
        // single file upload
        Dropzone.options.mDropzoneOne = {
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 5, // MB
            acceptedFiles: "image/*,application/pdf,application/csv,text/csv,application/vnd.ms-excel",
            addRemoveLinks : true,
            dictRemoveFile: "Quitar",
            dictMaxFilesExceeded: "Solo se permite un (1) archivo por campo.",
            dictResponseError: "Ha ocurrido un error",
            dictFileTooBig: "El tamaño del archivo debe ser menor a 5 MB",
            dictInvalidFileType: "Formatos soportados: JPG, PDF, GIF, PNG, DOC, XLS",
            dictInvalidFileType: "Formatos soportados: JPG, PDF, GIF, PNG, DOC, XLS",
            accept: function(file, done) {
                done();
            },
            success: function(file, response){
                toastr.success("Acción ejecutada con exito!");
                //console.info('response', file, response);
                $('form').append('<input type="hidden" name="'+response+'"  id="'+response+'" value="'+ file.name +'"/>');
            },
            error: function(file, errorMessage) {
                console.error('File upload error', errorMessage);
                //alert(errorMessage);
                toastr.error(errorMessage);
            },
        };
        //
        // // multiple file upload
        // Dropzone.options.mDropzoneTwo = {
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 10,
        //     maxFilesize: 10, // MB
        //     accept: function(file, done) {
        //         if (file.name == "justinbieber.jpg") {
        //             done("Naha, you don't.");
        //         } else {
        //             done();
        //         }
        //     }
        // };
        //
        // // file type validation
        // Dropzone.options.mDropzoneThree = {
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 10,
        //     maxFilesize: 10, // MB
        //     acceptedFiles: "image/*,application/pdf,.psd",
        //     accept: function(file, done) {
        //         if (file.name == "justinbieber.jpg") {
        //             done("Naha, you don't.");
        //         } else {
        //             done();
        //         }
        //     }
        // };
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

DropzoneDemo.init();
