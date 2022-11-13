CREATE TABLE "price_history" (
	"id" UUID NOT NULL DEFAULT uuid_generate_v1(),
	"currency" VARCHAR(10) NOT NULL,
	"symbol" VARCHAR(10) NOT NULL,
	"price" NUMERIC(16,8) NOT NULL,
	"source" VARCHAR(255) NOT NULL,
	"created_at" TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY ("id")
);
CREATE INDEX currency_and_symbol
ON price_history (currency,symbol);
