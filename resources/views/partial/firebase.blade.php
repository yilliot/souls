<script src="https://www.gstatic.com/firebasejs/5.1.0/firebase.js"></script>
<script>
var config = {
  apiKey: "AIzaSyDrwtUGpIQKz7eDqP-6Wxb9QlNacRnix8g",
  authDomain: "yjv-demo.firebaseapp.com",
  databaseURL: "https://yjv-demo.firebaseio.com",
  projectId: "yjv-demo",
  storageBucket: "yjv-demo.appspot.com",
  messagingSenderId: "675386861190"
};
firebase.initializeApp(config);
auth = firebase.auth();
window.db = firebase.firestore();
db.settings({timestampsInSnapshots: true});
window.firebaseDo = function (callback) {
  auth.signInWithEmailAndPassword('admin@mail.io', 'secret').then(function() {
    console.log('Logged in');
    callback();
  }).catch(function(e) {
    console.log(e);
  });
}
</script>