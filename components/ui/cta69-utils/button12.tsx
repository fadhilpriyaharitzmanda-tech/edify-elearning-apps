import React from "react";
import { cn } from "@/lib/utils";
import { ArrowRight } from "lucide-react";

export interface Button12Props {
  label?: string;
  asChild?: boolean;
  children?: React.ReactNode;
  className?: string;
  onClick?: () => void;
}

export function Button12({
  label,
  asChild,
  children,
  className,
  onClick,
}: Button12Props) {
  const content = (
    <>
      <span>{label}</span>
      <ArrowRight className="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" />
    </>
  );

  if (asChild && React.isValidElement(children)) {
    return React.cloneElement(
      children as React.ReactElement<{ className?: string; children?: React.ReactNode }>,
      {
        className: cn(
          "group relative inline-flex items-center justify-center gap-2.5 overflow-hidden rounded-full bg-primary px-8 py-3.5 text-base font-semibold text-white shadow-lg shadow-primary/25 transition-all duration-300 hover:bg-primary/90 hover:shadow-xl hover:shadow-primary/35 hover:-translate-y-0.5 active:translate-y-0 font-sans",
          (children.props as { className?: string })?.className,
          className
        ),
        children: content,
      }
    );
  }

  return (
    <button
      onClick={onClick}
      className={cn(
        "group relative inline-flex items-center justify-center gap-2.5 overflow-hidden rounded-full bg-primary px-8 py-3.5 text-base font-semibold text-white shadow-lg shadow-primary/25 transition-all duration-300 hover:bg-primary/90 hover:shadow-xl hover:shadow-primary/35 hover:-translate-y-0.5 active:translate-y-0 font-sans",
        className
      )}
    >
      {content}
    </button>
  );
}

export default Button12;
