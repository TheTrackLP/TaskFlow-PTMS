export const formattedDate = (dateValue) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateValue).toLocaleDateString("en-US", options);
};
