//Bot
const params = new URL(window.location.href).searchParams;
const configParams = params.get("config");
let config = {};

try {
  if (!configParams) {
    throw "No config passed";
  }
  Object.assign(config, tryDecode(configParams));
  window.botpress.init(config);
} catch (err) {
  showError(`Could not initialize webchat: ${err}`);
}

function Habilitar_bot() {
  const colors = [
    //"#d6409f",
    //"#3a8ed6",
    //"#f94d4d",
    //"#42d697",
    "#f2c14e"
    //"#9354e2",
    //"#e64f5e",
    //"#5ea4a4",
    //"#c35020",
    //"#7a3e9d"
    
  ];
  const variants = ["soft", "solid"]; //
  const themes = ["light", "dark"];

  try {
    botpress.fabIframe.remove();
  } catch {}
  try {
    botpress.webchatIframe.remove();
  } catch {}

  botpress.initialized = false;
  botpress.init({
    ...botpress,
    configuration: {
      ...botpress.configuration,
      color: pickRandom(colors),
      variant: pickRandom(variants),
      themeMode: pickRandom(themes)
    }
  });
}

window.botpress.on("*", (event) => {
  const eventsEl = document.getElementById("events");
  eventsEl.value += "\n" + JSON.stringify(event) + "\n";
  eventsEl.scrollTop = eventsEl.scrollHeight;
});

function pickRandom(arr) {
  return arr.at(Math.floor(Math.random() * arr.length));
}

function showError(error) {
  const el = document.getElementById("error");
  el.style.display = "block";
  el.innerText = error;
}

let check = setInterval(function () {
  if (window.botpress.initialized) {
    const el = document.getElementById("success");
    el.style.display = "block";
    el.innerText = "Initialized: " + window.botpress.botId;
    clearInterval(check);
  }
}, 500);

function tryDecode(str) {
  try {
    return JSON.parse(decodeURIComponent(atob(str)));
  } catch {}

  try {
    return JSON.parse(atob(str));
  } catch {}

  return {};
}