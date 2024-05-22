// Definição dos pinos do sensor ultrassônico
const int trigPin = 9;    // Pino de trigger do sensor
const int echoPin = 10;   // Pino de echo do sensor

// Definição dos pinos do LED RGB
const int redPin = 6;     // Pino do LED RGB (vermelho)
const int greenPin = 2 ;   // Pino do LED RGB (verde)
const int bluePin = 4;    // Pino do LED RGB (azul)

// Variáveis para armazenar o tempo de ida e volta do pulso ultrassônico
long duration;
int distance;

void setup() {
  Serial.begin(9600);      // Inicialização da comunicação serial
  pinMode(trigPin, OUTPUT);// Configura o pino de trigger como saída
  pinMode(echoPin, INPUT); // Configura o pino de echo como entrada
  pinMode(redPin, OUTPUT); // Configura o pino do LED vermelho como saída
  pinMode(greenPin, OUTPUT);// Configura o pino do LED verde como saída
  pinMode(bluePin, OUTPUT); // Configura o pino do LED azul como saída
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
  
  // Imprime a distância medida na porta serial
  Serial.print(distance);
  Serial.println("cm");

  // Define as cores com base na distância
  if (distance <= 15) { // Verde
    setColor(0, 255, 0); // R, G, B
  } else if (distance > 15 && distance <= 30) { // Amarelo
    setColor(255, 255, 0); // R, G, B
  } else { // Vermelho
    setColor(255, 0, 0); // R, G, B
  }
  
  delay(1000); // Aguarda 1 segundo antes de medir novamente
}

// Função para definir a cor do LED RGB
void setColor(int red, int green, int blue) {
  analogWrite(redPin, red);
  analogWrite(greenPin, green);
  analogWrite(bluePin, blue);
}