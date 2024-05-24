// Definição dos pinos do sensor ultrassônico
const int trigPin = 9;    // Pino de trigger do sensor
const int echoPin = 10;   // Pino de echo do sensor
const int redPin = 6;     // Pino do LED RGB (vermelho)
const int greenPin = 2;   // Pino do LED RGB (verde)
const int bluePin = 4;    // Pino do LED RGB (azul)
const int relayPin = 8;   // Pino de controle do relé

// Variáveis para armazenar o tempo de ida e volta do pulso ultrassônico
long duration;
int distance;

// Dimensões do recipiente
const float comprimento = 8.5; // cm
const float alturaTotal = 20.0; // cm
const float largura = 5.88; // cm, calculada previamente

void setup() {
  Serial.begin(9600);      // Inicialização da comunicação serial
  pinMode(trigPin, OUTPUT);// Configura o pino de trigger como saída
  pinMode(echoPin, INPUT); // Configura o pino de echo como entrada
  pinMode(redPin, OUTPUT); // Configura o pino do LED vermelho como saída
  pinMode(greenPin, OUTPUT);// Configura o pino do LED verde como saída
  pinMode(bluePin, OUTPUT); // Configura o pino do LED azul como saída
  pinMode(relayPin, OUTPUT); // Configura o pino do relé como saída
  digitalWrite(relayPin, HIGH); // Inicialmente desliga o relé (assumindo que HIGH desliga o relé)
}

void loop() {
  // Dispara um pulso de 10 microssegundos no pino de trigger
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  
  // Mede a duração do pulso no pino de echo
  duration = pulseIn(echoPin, HIGH);
  
  // Calcula a distância em centímetros
  distance = duration * 0.034 / 2;
  
  // Calcula a altura do líquido no recipiente
  float alturaLiquido = alturaTotal - distance;

  // Calcula o volume em cm³
  float volumeCm3 = comprimento * largura * alturaLiquido;

  // Converte o volume para litros
  float volumeLitros = volumeCm3 / 1000.0;

  // Imprime a distância na porta serial
  
  Serial.print(distance);
  Serial.println("");

  // Define as cores com base na altura do líquido
  if (distance <= 5) { // Azul
    setColor(0, 0, 255); // R, G, B
  } else if (distance <= 10) { // Verde
    setColor(0, 255, 0); // R, G, B
  } else if (distance <= 15) { // Amarelo
    setColor(255,140,0); // R, G, B
  } else if (distance <= 20) { // Laranja
    setColor(255,69,0); // R, G, B
  } else if(distance >= 28) { // Vermelho
    setColor(255, 0, 0); // R, G, B
  }

  // Controle do relé baseado na altura do líquido
  if (alturaLiquido > 10) { // Considerando que a altura menor que 10 cm significa tanque quase vazio
    digitalWrite(relayPin, LOW); // Liga o relé
  } else { // Considerando que a altura maior ou igual a 10 cm significa tanque não vazio
    digitalWrite(relayPin, HIGH); // Desliga o relé
  }
  
  delay(1000); // Aguarda 1 segundo antes de medir novamente
}

void setColor(int red, int green, int blue) {
  analogWrite(redPin, red);
  analogWrite(greenPin, green);
  analogWrite(bluePin, blue);
}
