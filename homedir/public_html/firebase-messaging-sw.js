importScripts('https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js');

var firebaseConfig = {
          apiKey: "AIzaSyAIsCMNWF20M0Txl1sWnqDTi0zbAo069o8",
          authDomain: "ongbatasms.firebaseapp.com",
          projectId: "ongbatasms",
          storageBucket: "ongbatasms.appspot.com",
          messagingSenderId: "446497206451",
          appId: "1:446497206451:web:618d347ba84737bc88c0c6",
          measurementId: "G-NF0KTFJHDG"
};

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
}); 