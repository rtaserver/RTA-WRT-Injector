<!DOCTYPE html>
<html>
<head>
    <title>RTA-WRT Injector</title>
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-4">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md max-h-screen overflow-y-auto">
        <h1 class="text-2xl font-bold text-center text-teal-700 mb-6">RTA-WRT INJECTOR</h1>
        <div class="flex justify-center mb-6">
            <button class="bg-teal-700 text-white px-4 py-2 rounded-l hover:bg-teal-800" onclick="showSection('home')">Home</button>
            <button class="bg-teal-700 text-white px-4 py-2 hover:bg-teal-800" onclick="showSection('log')">Log</button>
            <button class="bg-teal-700 text-white px-4 py-2 hover:bg-teal-800" onclick="showSection('config')">Config</button>
            <button class="bg-teal-700 text-white px-4 py-2 rounded-r hover:bg-teal-800" onclick="showSection('about')">About</button>
        </div>
        
        <!-- Home Section -->
        <div id="home" class="section">
            <h2 class="text-xl font-bold text-teal-700 mb-4">Home</h2>
            <form onsubmit="return false;">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Status Overview:</label>
                    <div class="bg-gray-50 p-4 rounded border">
                        <div class="flex justify-between mb-2">
                            <span><i id="statusOverview" class="fa fa-circle text-gray-400"></i> Status: <span id="statusText">Disconnected</span></span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span><i id="wanOverview" class="fa fa-server text-gray-400"></i> WAN: <span id="wanText">N/A</span></span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span><i id="locationOverview" class="fa fa-flag-o text-gray-400"></i> Location: <span id="locationText">N/A</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span><i id="ispOverview" class="fa fa-globe text-gray-400"></i> ISP: <span id="ispText">N/A</span></span>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Options:</label>
                    <div class="bg-gray-50 p-4 rounded border space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="tun2socks" class="mr-2 w-4 h-4">
                            <label for="tun2socks" class="cursor-pointer">Use tun2socks</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="memoryCleaner" class="mr-2 w-4 h-4">
                            <label for="memoryCleaner" class="cursor-pointer">Memory cleaner</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="autoReconnect" class="mr-2 w-4 h-4">
                            <label for="autoReconnect" class="cursor-pointer">Auto Reconnect</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="pingLoop" class="mr-2 w-4 h-4">
                            <label for="pingLoop" class="cursor-pointer">Ping Loop</label>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" id="startButton" class="bg-teal-700 hover:bg-teal-800 text-white w-full px-4 py-2 rounded mb-2" onclick="handleStartButton()">Start</button>
                    <button type="button" id="stopButton" class="bg-red-700 hover:bg-red-800 text-white w-full px-4 py-2 rounded hidden" onclick="handleStopButton()">Stop</button>
                </div>
            </form>
        </div>
        
        <!-- Log Section -->
        <div id="log" class="section hidden">
            <h2 class="text-xl font-bold text-teal-700 mb-4">Log</h2>
            <textarea id="getlog" class="w-full px-3 py-2 border rounded mb-4 font-mono text-sm bg-gray-900 text-green-400" style="height: 30rem" readonly>Waiting for logs...</textarea>
            <button id="btnClean" class="bg-teal-700 hover:bg-teal-800 text-white w-full px-4 py-2 rounded" onclick="cleanLog()">Clear Logs</button>
        </div>
        
        <!-- Config Section -->
        <div id="config" class="section hidden">
            <h2 class="text-xl font-bold text-teal-700 mb-4">Config</h2>
            <form onsubmit="return false;">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Mode:</label>
                    <select id="mode" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" onchange="handleModeChange()">
                        <option value="SSH">SSH</option>
                        <option value="SSH - SSL">SSH - SSL</option>
                        <option value="SSH - WS - CDN">SSH - WS - CDN</option>
                    </select>
                </div>
                <div class="mb-4 flex space-x-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">Server Host:</label>
                        <input type="text" id="serverHost" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="bug/server.com" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">Server Port:</label>
                        <input type="number" id="serverPort" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="443" required>
                    </div>
                </div>
                <div class="mb-4 flex space-x-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">Username:</label>
                        <input type="text" id="username" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="rtawrt" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">Password:</label>
                        <input type="password" id="password" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="rtawrt" required>
                    </div>
                </div>
                <div id="enableHttpProxyField" class="mb-4 flex items-center">
                    <input type="checkbox" id="enableHttpProxy" class="mr-2 w-4 h-4" onchange="handleHttpProxyChange()">
                    <label for="enableHttpProxy" class="cursor-pointer font-semibold">Enable HTTP Proxy</label>
                </div>
                <div id="payloadField" class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Payload:</label>
                    <textarea id="payload" class="w-full px-3 py-2 border rounded h-24 focus:outline-none focus:ring-2 focus:ring-teal-500 font-mono text-sm" placeholder="GET http://bug.com/ HTTP/1.1[crlf][crlf]CONNECT [host_port] HTTP/1.1[crlf]Connection: keep-alive[crlf][crlf]" required></textarea>
                </div>
                <div id="proxyFields" class="mb-4 flex space-x-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">Proxy Server:</label>
                        <input type="text" id="proxyServer" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="127.0.0.1" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-semibold mb-2">Proxy Port:</label>
                        <input type="number" id="proxyPort" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="8080" required>
                    </div>
                </div>
                <div id="sniField" class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">SNI:</label>
                    <input type="text" id="sni" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="bug.com" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">UDPGW:</label>
                    <input type="number" id="udpgw" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="7300" required>
                </div>
                <div class="mb-4">
                    <button type="button" id="saveButton" class="bg-teal-700 hover:bg-teal-800 text-white w-full px-4 py-2 rounded" onclick="handleSaveButton()">Save Configuration</button>
                </div>
            </form>
        </div>
        
        <!-- About Section -->
        <div id="about" class="section hidden">
            <h2 class="text-xl font-bold text-teal-700 mb-4">About</h2>
            <div class="text-gray-700 space-y-2">
                <p class="font-semibold">RTA-WRT Injector v1.0.0 Beta</p>
                <p>© 2024 RTA-WRT Injector</p>
                <p class="text-sm">This application is designed for SSH tunneling with various connection modes including SSL and WebSocket support.</p>
                <hr class="my-4">
                <p class="text-xs text-gray-500">For support and updates, please visit our website.</p>
            </div>
        </div>
    </div>
    <?php include("javascript.php"); ?>
    <script>
        // Section Navigation
        function showSection(sectionName) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionName).classList.remove('hidden');
            
            if (sectionName === 'log') {
                startLogPolling();
            } else {
                stopLogPolling();
            }
        }

        // API Call Helper
        async function apiCall(action, data = {}) {
            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ action, data })
                });
                return await response.json();
            } catch (error) {
                console.error('API Error:', error);
                alert('Connection error: ' + error.message);
                return null;
            }
        }

        // Load Configuration
        async function loadConfig() {
            const result = await apiCall('getConfig');
            if (result && result.status === 'OK') {
                const config = result.data;
                document.getElementById('tun2socks').checked = config.tun2socks === '1';
                document.getElementById('memoryCleaner').checked = config.memoryCleaner === '1';
                document.getElementById('autoReconnect').checked = config.autoReconnect === '1';
                document.getElementById('pingLoop').checked = config.pingLoop === '1';
                document.getElementById('mode').value = config.mode;
                document.getElementById('serverHost').value = config.serverHost;
                document.getElementById('serverPort').value = config.serverPort;
                document.getElementById('username').value = config.username;
                document.getElementById('password').value = config.password;
                document.getElementById('enableHttpProxy').checked = config.enableHttpProxy === '1';
                document.getElementById('payload').value = config.payload;
                document.getElementById('proxyServer').value = config.proxyServer;
                document.getElementById('proxyPort').value = config.proxyPort;
                document.getElementById('sni').value = config.sni;
                document.getElementById('udpgw').value = config.udpgw;
                handleModeChange();
                handleHttpProxyChange();
            }
        }

        // Handle Mode Change
        function handleModeChange() {
            const mode = document.getElementById('mode').value;
            const payloadField = document.getElementById('payloadField');
            const sniField = document.getElementById('sniField');
            const enableHttpProxyField = document.getElementById('enableHttpProxyField');
            
            if (mode === 'SSH') {
                payloadField.classList.add('hidden');
                sniField.classList.add('hidden');
                enableHttpProxyField.classList.add('hidden');
            } else if (mode === 'SSH - SSL') {
                payloadField.classList.remove('hidden');
                sniField.classList.remove('hidden');
                enableHttpProxyField.classList.remove('hidden');
            } else if (mode === 'SSH - WS - CDN') {
                payloadField.classList.remove('hidden');
                sniField.classList.remove('hidden');
                enableHttpProxyField.classList.remove('hidden');
            }
        }

        // Handle HTTP Proxy Change
        function handleHttpProxyChange() {
            const enableHttpProxy = document.getElementById('enableHttpProxy').checked;
            const proxyFields = document.getElementById('proxyFields');
            
            if (enableHttpProxy) {
                proxyFields.classList.remove('hidden');
            } else {
                proxyFields.classList.add('hidden');
            }
        }

        // Save Configuration
        async function handleSaveButton() {
            const config = {
                tun2socks: document.getElementById('tun2socks').checked ? '1' : '0',
                memoryCleaner: document.getElementById('memoryCleaner').checked ? '1' : '0',
                autoReconnect: document.getElementById('autoReconnect').checked ? '1' : '0',
                pingLoop: document.getElementById('pingLoop').checked ? '1' : '0',
                mode: document.getElementById('mode').value,
                modeconfig: document.getElementById('mode').value,
                enableHttpProxy: document.getElementById('enableHttpProxy').checked ? '1' : '0',
                payload: document.getElementById('payload').value,
                proxyServer: document.getElementById('proxyServer').value,
                proxyPort: document.getElementById('proxyPort').value,
                serverHost: document.getElementById('serverHost').value,
                serverPort: document.getElementById('serverPort').value,
                username: document.getElementById('username').value,
                password: document.getElementById('password').value,
                udpgw: document.getElementById('udpgw').value,
                sni: document.getElementById('sni').value
            };
            
            const result = await apiCall('saveConfig', config);
            if (result && result.status === 'success') {
                alert('Configuration saved successfully!');
            } else {
                alert('Failed to save configuration!');
            }
        }

        // Disable/Enable Options
        function disableOptions(disabled) {
            // Disable checkboxes in Home section
            document.getElementById('tun2socks').disabled = disabled;
            document.getElementById('memoryCleaner').disabled = disabled;
            document.getElementById('autoReconnect').disabled = disabled;
            document.getElementById('pingLoop').disabled = disabled;
            
            // Disable all inputs in Config section
            document.getElementById('mode').disabled = disabled;
            document.getElementById('serverHost').disabled = disabled;
            document.getElementById('serverPort').disabled = disabled;
            document.getElementById('username').disabled = disabled;
            document.getElementById('password').disabled = disabled;
            document.getElementById('enableHttpProxy').disabled = disabled;
            document.getElementById('payload').disabled = disabled;
            document.getElementById('proxyServer').disabled = disabled;
            document.getElementById('proxyPort').disabled = disabled;
            document.getElementById('sni').disabled = disabled;
            document.getElementById('udpgw').disabled = disabled;
            document.getElementById('saveButton').disabled = disabled;
        }

        // Start Tunnel
        async function handleStartButton() {
            document.getElementById('startButton').disabled = true;
            document.getElementById('startButton').textContent = 'Starting...';
            
            const result = await apiCall('startTunnel');
            
            if (result && result.status === 'OK') {
                document.getElementById('startButton').classList.add('hidden');
                document.getElementById('stopButton').classList.remove('hidden');
                disableOptions(true); // Disable all options
                updateStatus();
            } else {
                alert('Failed to start tunnel!');
                document.getElementById('startButton').disabled = false;
                document.getElementById('startButton').textContent = 'Start';
            }
        }

        // Stop Tunnel
        async function handleStopButton() {
            document.getElementById('stopButton').disabled = true;
            document.getElementById('stopButton').textContent = 'Stopping...';
            
            const result = await apiCall('stopTunnel');
            
            if (result && result.status === 'OK') {
                document.getElementById('stopButton').classList.add('hidden');
                document.getElementById('startButton').classList.remove('hidden');
                document.getElementById('startButton').disabled = false;
                document.getElementById('startButton').textContent = 'Start';
                disableOptions(false); // Enable all options back
                updateStatus();
            } else {
                alert('Failed to stop tunnel!');
                document.getElementById('stopButton').disabled = false;
                document.getElementById('stopButton').textContent = 'Stop';
            }
        }

        // Update Status
        async function updateStatus() {
            const result = await apiCall('getStatus');
            if (result && result.status === 'OK') {
                const status = result.data.status;
                const statusIcon = document.getElementById('statusOverview');
                const statusText = document.getElementById('statusText');
                
                if (status === 'CONNECTED' || status === 'CONNECTING') {
                    statusIcon.className = 'fa fa-circle text-green-500';
                    statusText.textContent = status;
                } else {
                    statusIcon.className = 'fa fa-circle text-gray-400';
                    statusText.textContent = 'Disconnected';
                }
            }
        }

        // Log Polling
        let logInterval = null;
        
        function startLogPolling() {
            if (logInterval) return;
            
            logInterval = setInterval(async () => {
                const result = await apiCall('log');
                if (result && result.status === 'OK') {
                    document.getElementById('getlog').value = result.data;
                    // Auto scroll to bottom
                    const textarea = document.getElementById('getlog');
                    textarea.scrollTop = textarea.scrollHeight;
                }
            }, 1000);
        }
        
        function stopLogPolling() {
            if (logInterval) {
                clearInterval(logInterval);
                logInterval = null;
            }
        }

        // Clean Log
        async function cleanLog() {
            const result = await apiCall('cleanLog');
            document.getElementById('getlog').value = 'Logs cleared...';
        }

        // Initialize
        window.addEventListener('load', () => {
            loadConfig();
            updateStatus();
            setInterval(updateStatus, 5000); // Update status every 5 seconds
            
            // Check if tunnel is already running on page load
            checkInitialStatus();
        });
        
        // Check initial status to disable options if tunnel is running
        async function checkInitialStatus() {
            const result = await apiCall('getStatus');
            if (result && result.status === 'OK') {
                const status = result.data.status;
                if (status === 'CONNECTED' || status === 'CONNECTING') {
                    document.getElementById('startButton').classList.add('hidden');
                    document.getElementById('stopButton').classList.remove('hidden');
                    disableOptions(true);
                }
            }
        }
    </script>
</body>
</html>
