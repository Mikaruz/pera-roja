import random
from faker import Faker

fake = Faker()

data = []
data2 = []

userid = 30030
userdataid = 30030


for _ in range(5000):
    genero = random.choice([0, 1])
    altura = random.randint(140, 190)
    peso = random.randint(40, 120)
    nivel = random.randint(1, 4)
    objetivo = random.randint(1, 3)
    edad = random.randint(15, 90)

    correo = fake.last_name() + fake.last_name() + fake.city() + str(altura) + str(peso) + str(nivel) + '@usil.com'


    data.append(
        (
            userid,
            userdataid,
            fake.first_name(),
            fake.last_name(),
            fake.city(),
            fake.street_address(),
            fake.postcode(),
            fake.phone_number(),
            genero,
            altura,
            peso,
            nivel,
            objetivo,
            edad
        )
    )

    data2.append(
        (
            userid,
            correo,
            fake.password(),
        )
    )

    userid+= 1
    userdataid+= 1



