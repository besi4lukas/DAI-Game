
class Dai:

    def __init__(self, player1, player2, number1, number2):
        self.players = [player1, player2]
        self.numbers = [number1, number2]
        self.history = [[],[]]
        self.turn = 0
        self.instruction = "play"

    def play(self):
        while self.instruction != "stop":
            print (self.players[self.turn],"'s turn")
            guess = input("Enter guess: ")
            self.instruction = guess
            if self.instruction != "stop":
                self.compare(guess, self.numbers[(self.turn+1)%2])
                self.turn = (self.turn+1)%2
                print("\n\n")
            else:
                break


    def compare(self, g, n):
        guess = str(g)
        print ( guess )
        number = str(n)
        dead = 0
        injured = 0        
        for index in range(len(guess)):
            if guess[index] in number:
                if int(guess[index]) == int(number[index]):
                    dead += 1
                else:
                    injured += 1
        
        print (dead," dead and ",injured," injured")
        if dead == 3:
            print ("You won")
            self.instruction = "stop"

if __name__ == '__main__':
    game = Dai("Atikpozomara", "Besi4lukas", 184, 720)
    game.play()

        

