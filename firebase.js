const firebaseConfig = {
  apiKey: "",
  authDomain: "",
  projectId: "",
  storageBucket: "",
  messagingSenderId: "",
  appId: ""
};

// Inicializa Firebase solo si no está inicializado
if (!firebase.apps?.length) {
  firebase.initializeApp(firebaseConfig);
}
const storage = firebase.storage();


async function subirImagenFirebase(file) {
  if (!['image/png', 'image/jpeg'].includes(file.type)) {
    throw new Error('Solo se permiten imágenes PNG o JPG');
  }
  const storageRef = storage.ref('productos/' + Date.now() + '_' + file.name);
  await storageRef.put(file);
  return await storageRef.getDownloadURL();
}


window.subirImagenFirebase = subirImagenFirebase;