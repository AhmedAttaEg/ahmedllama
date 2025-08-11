<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sum Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        input, button { margin: 0.5rem 0; padding: 0.5rem; font-size: 1rem; }
        #result { margin-top: 1rem; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Sum Calculator</h1>

    <div>
        <label for="a">First number:</label>
        <input type="text" id="a" placeholder="Enter a number">

        <label for="b">Second number:</label>
        <input type="text" id="b" placeholder="Enter another number">

        <button id="calcBtn">Calculate</button>
    </div>

    <div id="result"></div>

    <script>
        document.getElementById('calcBtn').addEventListener('click', function () {
            const a = document.getElementById('a').value;
            const b = document.getElementById('b').value;
            //const url = `http://127.0.0.1/ahmedllama/public/api/sum/${encodeURIComponent(a)}/${encodeURIComponent(b)}`;
            const url = `../api/sum/${encodeURIComponent(a)}/${encodeURIComponent(b)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const resultEl = document.getElementById('result');

                    if (data.error) {
                        resultEl.textContent = data.error;
                        resultEl.style.color = 'red';
                    } else {
                        resultEl.textContent = 
                          `Sum of ${data.a} and ${data.b} is ${data.sum}.`;
                        resultEl.style.color = 'green';
                    }
                })
                .catch(() => {
                    document.getElementById('result').textContent = 
                      'An unexpected error occurred.';
                });
        });
    </script>
</body>
</html>
