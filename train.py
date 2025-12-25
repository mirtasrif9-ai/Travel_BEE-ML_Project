import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score
import joblib

# Load dataset
data = pd.read_csv('Endgame_tour_dataset_ultimate_final_Pro_Max.csv')
data = data.dropna()

# Encode categorical variables
encoded_data = pd.get_dummies(data, columns=["From", "Budget", "Type"], drop_first=True)

# Define features and target
X = encoded_data.drop(columns=["Destination", "City"])
y = data["Destination"]

# Split the dataset
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train the model
model = RandomForestClassifier(n_estimators=100, random_state=42)
model.fit(X_train, y_train)



# Make predictions on the test dataset
y_pred = model.predict(X_test)

# Calculate accuracy
accuracy = accuracy_score(y_test, y_pred)

print(f"Model Accuracy: {accuracy * 100:.2f}%")



from sklearn.metrics import classification_report

from sklearn.metrics import log_loss

# Log Loss
y_pred_proba = model.predict_proba(X_test)
logloss = log_loss(y_test, y_pred_proba)
print(f"Log Loss: {logloss:.2f}")

from sklearn.metrics import mean_squared_error
import pandas as pd

# Convert categorical labels to numeric
y_test_numeric = pd.factorize(y_test)[0]
y_pred_numeric = pd.factorize(pd.Series(y_pred, index=y_test.index))[0]

# MSE
mse = mean_squared_error(y_test_numeric, y_pred_numeric)
print(f"Mean Squared Error: {mse:.2f}")



